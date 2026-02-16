<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WonderStoreProduct;
use App\Models\WonderStoreCategory;
use Illuminate\Support\Facades\Storage;

class AdminWonderStoreProductController extends Controller
{
    public function index(Request $request)
    {
        $query = WonderStoreProduct::with('category');

        if ($request->filled('search')) {
            $query->where('product_description', 'like', '%' . $request->search . '%')
                ->orWhereHas('category', function ($q) use ($request) {
                    $q->where('category_name', 'like', '%' . $request->search . '%');
                });
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = WonderStoreCategory::where('is_active', true)->get();

        if ($request->ajax()) {
            return view('admin.wonder_store.products._table', compact('products'))->render();
        }

        return view('admin.wonder_store.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = WonderStoreCategory::where('is_active', true)->get();
        return view('admin.wonder_store.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:wonder_store_categories,id',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable',
        ]);

        $data = $request->except('product_image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('product_image')) {
            $data['product_image'] = $request->file('product_image')->store('uploads/wonder_store/products', 'public');
        }

        WonderStoreProduct::create($data);

        return redirect()->route('admin.wonder-store-products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WonderStoreProduct $wonderStoreProduct)
    {
        $categories = WonderStoreCategory::where('is_active', true)->get();
        return view('admin.wonder_store.products.edit', compact('wonderStoreProduct', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WonderStoreProduct $wonderStoreProduct)
    {
        $request->validate([
            'category_id' => 'required|exists:wonder_store_categories,id',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'product_price' => 'required|numeric|min:0',
            'product_description' => 'nullable',
        ]);

        $data = $request->except('product_image');
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('product_image')) {
            // Delete old image
            if ($wonderStoreProduct->product_image) {
                Storage::disk('public')->delete($wonderStoreProduct->product_image);
            }
            $data['product_image'] = $request->file('product_image')->store('uploads/wonder_store/products', 'public');
        }

        $wonderStoreProduct->update($data);

        return redirect()->route('admin.wonder-store-products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WonderStoreProduct $wonderStoreProduct)
    {
        if ($wonderStoreProduct->product_image) {
            Storage::disk('public')->delete($wonderStoreProduct->product_image);
        }
        $wonderStoreProduct->delete();

        return redirect()->route('admin.wonder-store-products.index')->with('success', 'Product deleted successfully.');
    }
}
