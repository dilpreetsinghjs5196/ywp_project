<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WonderStoreProduct;
use App\Models\SiteSetting;
use App\Models\PageContent;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $guestId = request()->cookie('guest_cart_id');

        if (Auth::check()) {
            CartItem::syncSessionCart(Auth::id(), $guestId);
            $cartItems = CartItem::where('user_id', Auth::id())->with('product.category')->get();
        } else {
            CartItem::syncSessionCart(null, $guestId); // Sync session to DB guest record
            $cartItems = CartItem::where('guest_id', $guestId)->with('product.category')->get();
        }

        $cart = [];
        foreach ($cartItems as $item) {
            $cart[$item->product_id] = [
                "id" => $item->product_id,
                "name" => $item->product->category->category_name . " Item",
                "quantity" => $item->quantity,
                "price" => $item->product->product_price,
                "image" => $item->product->product_image,
                "category" => $item->product->category->category_name
            ];
        }
        session()->put('cart', $cart);

        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        return view('site.com.cart', compact('cart', 'settings', 'contents'));
    }

    public function loginAjax(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            CartItem::syncSessionCart(Auth::id(), $request->cookie('guest_cart_id')); // Restore cart from DB immediately
            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => 'The provided credentials do not match our records.',
        ], 401);
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty'], 400);
        }

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'payment_method' => 'required|string',
            'permanent_address' => 'required_without:same_as_shipping|nullable|string',
            'permanent_city' => 'required_without:same_as_shipping|nullable|string|max:100',
            'permanent_state' => 'required_without:same_as_shipping|nullable|string|max:100',
            'permanent_postcode' => 'required_without:same_as_shipping|nullable|string|max:20',
            'permanent_country' => 'required_without:same_as_shipping|nullable|string|max:100',
        ];

        if (!Auth::check()) {
            $rules['create_account'] = 'required|accepted';
            $rules['password'] = 'required|min:8|confirmed';
            $rules['email'] = 'required|email|max:255|unique:users,email';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        DB::beginTransaction();
        try {
            $user_id = Auth::id();

            // Handle registration or association with existing account
            if ($request->has('create_account') && !Auth::check()) {
                $user = User::create([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'postcode' => $request->postcode,
                    'country' => $request->country,
                    'password' => Hash::make($request->password),
                ]);
                Auth::login($user);
                CartItem::syncSessionCart($user->id, $request->cookie('guest_cart_id'));
                $user_id = $user->id;
            } elseif (Auth::check()) {
                // Update existing user profile if fields are empty
                $user = Auth::user();
                $user->update([
                    'phone' => $user->phone ?? $request->phone,
                    'address' => $user->address ?? $request->address,
                    'city' => $user->city ?? $request->city,
                    'state' => $user->state ?? $request->state,
                    'postcode' => $user->postcode ?? $request->postcode,
                    'country' => $user->country ?? $request->country,
                ]);
            } elseif (!$user_id) {
                // Check if a user with this email already exists and just link the order
                $existingUser = User::where('email', $request->email)->first();
                if ($existingUser) {
                    $user_id = $existingUser->id;
                }
            }

            // Calculate total
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }

            // Handle same address logic
            $perm_address = $request->has('same_as_shipping') ? $request->address : $request->permanent_address;
            $perm_city = $request->has('same_as_shipping') ? $request->city : $request->permanent_city;
            $perm_state = $request->has('same_as_shipping') ? $request->state : $request->permanent_state;
            $perm_postcode = $request->has('same_as_shipping') ? $request->postcode : $request->permanent_postcode;
            $perm_country = $request->has('same_as_shipping') ? $request->country : $request->permanent_country;

            // Create Order
            $order = Order::create([
                'user_id' => $user_id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country' => $request->country,
                'permanent_address' => $perm_address,
                'permanent_city' => $perm_city,
                'permanent_state' => $perm_state,
                'permanent_postcode' => $perm_postcode,
                'permanent_country' => $perm_country,
                'total_amount' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
            ]);

            // Create Order Items
            foreach ($cart as $productId => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }

            DB::commit();

            if (Auth::check()) {
                CartItem::where('user_id', Auth::id())->delete();
            } else {
                CartItem::where('guest_id', $request->cookie('guest_cart_id'))->delete();
            }

            session()->forget('cart');

            if ($request->payment_method === 'online') {
                // Initialize Razorpay API (Directly from DB to avoid cache issues)
                $razorpayKeyId = \App\Models\SiteSetting::where('key', 'razorpay_key_id')->value('value') ?? config('services.razorpay.key_id');
                $razorpayKeySecret = \App\Models\SiteSetting::where('key', 'razorpay_key_secret')->value('value') ?? config('services.razorpay.key_secret');

                $api = new \Razorpay\Api\Api($razorpayKeyId, $razorpayKeySecret);
                
                // Create Razorpay Order
                $razorpayOrder = $api->order->create([
                    'receipt' => 'order_' . $order->id,
                    'amount' => (int) round($total * 100),
                    'currency' => config('services.razorpay.currency'),
                    'payment_capture' => 1
                ]);

                return response()->json([
                    'success' => true,
                    'require_payment' => true,
                    'razorpay_key' => $razorpayKeyId,
                    'razorpay_order_id' => $razorpayOrder->id,
                    'currency' => config('services.razorpay.currency'),
                    'amount' => $total * 100, // Razorpay works in paise
                    'new_token' => csrf_token(),
                    'order_id' => $order->id,
                    'customer' => [
                        'name' => $request->first_name . ' ' . $request->last_name,
                        'email' => $request->email,
                        'contact' => $request->phone
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'redirect' => route('com.order.success', $order->id)
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error processing order: ' . $e->getMessage()
            ], 500);
        }
    }

    public function orderSuccess($id)
    {
        $order = Order::with('items')->findOrFail($id);
        $settings = SiteSetting::all()->pluck('value', 'key');

        $contents = PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        return view('site.com.order-success', compact('order', 'settings', 'contents'));
    }

    public function add(Request $request, $id)
    {
        $product = WonderStoreProduct::with('category')->findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->category->category_name . " Item",
                "quantity" => 1,
                "price" => $product->product_price,
                "image" => $product->product_image,
                "category" => $product->category->category_name
            ];
        }

        session()->put('cart', $cart);

        if (Auth::check()) {
            CartItem::updateOrCreate(
                ['user_id' => Auth::id(), 'product_id' => $id],
                ['quantity' => $cart[$id]['quantity'], 'guest_id' => null]
            );
        } else {
            CartItem::updateOrCreate(
                ['guest_id' => $request->cookie('guest_cart_id'), 'product_id' => $id],
                ['quantity' => $cart[$id]['quantity'], 'user_id' => null]
            );
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => count($cart)
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            if (Auth::check()) {
                CartItem::where('user_id', Auth::id())
                    ->where('product_id', $request->id)
                    ->update(['quantity' => $request->quantity]);
            } else {
                CartItem::where('guest_id', $request->cookie('guest_cart_id'))
                    ->where('product_id', $request->id)
                    ->update(['quantity' => $request->quantity]);
            }

            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);

                if (Auth::check()) {
                    CartItem::where('user_id', Auth::id())
                        ->where('product_id', $request->id)
                        ->delete();
                } else {
                    CartItem::where('guest_id', $request->cookie('guest_cart_id'))
                        ->where('product_id', $request->id)
                        ->delete();
                }
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    public function getCartCount()
    {
        if (Auth::check()) {
            $count = CartItem::where('user_id', Auth::id())->count();
        } else {
            $count = CartItem::where('guest_id', request()->cookie('guest_cart_id'))->count();
        }

        return response()->json(['count' => $count]);
    }

    public function checkout()
    {
        $guestId = request()->cookie('guest_cart_id');

        if (Auth::check()) {
            CartItem::syncSessionCart(Auth::id(), $guestId);
            $cartItems = CartItem::where('user_id', Auth::id())->with('product.category')->get();
        } else {
            CartItem::syncSessionCart(null, $guestId);
            $cartItems = CartItem::where('guest_id', $guestId)->with('product.category')->get();
        }

        $cart = [];
        foreach ($cartItems as $item) {
            $cart[$item->product_id] = [
                "id" => $item->product_id,
                "name" => $item->product->category->category_name . " Item",
                "quantity" => $item->quantity,
                "price" => $item->product->product_price,
                "image" => $item->product->product_image,
                "category" => $item->product->category->category_name
            ];
        }
        session()->put('cart', $cart);

        if (empty($cart)) {
            return redirect()->route('com.cart')->with('error', 'Your cart appears to be empty on our server. Please try adding items again.');
        }

        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        return view('site.com.checkout', compact('cart', 'settings', 'contents'));
    }

    public function checkEmail(Request $request)
    {
        $exists = User::where('email', $request->email)->exists();
        return response()->json(['exists' => $exists]);
    }
    public function verifyPayment(Request $request)
    {
        $order = Order::findOrFail($request->order_id);

        try {
            // 1. Initialize Razorpay API (Directly from DB)
            $razorpayKeyId = \App\Models\SiteSetting::where('key', 'razorpay_key_id')->value('value') ?? config('services.razorpay.key_id');
            $razorpayKeySecret = \App\Models\SiteSetting::where('key', 'razorpay_key_secret')->value('value') ?? config('services.razorpay.key_secret');
            
            $api = new \Razorpay\Api\Api($razorpayKeyId, $razorpayKeySecret);

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            // 2. Verify Signature
            $api->utility->verifyPaymentSignature($attributes);

            // 3. Update Order
            $order->update([
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'status' => 'processing'
            ]);

            return response()->json(['success' => true, 'redirect' => route('com.order.success', $order->id)]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed: ' . $e->getMessage()], 400);
        }
    }
}
