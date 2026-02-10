<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WonderStoreProduct;
use App\Models\WonderStoreCategory;
use App\Models\PageContent;
use App\Models\SiteSetting;

class WonderStoreController extends Controller
{
    public function index(Request $request)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'wonder_store')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        $query = WonderStoreProduct::with('category')->where('is_active', true);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('category_name', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where('product_description', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = WonderStoreCategory::where('is_active', true)->get();

        if ($request->ajax()) {
            return view('site.com.partials._product_list', compact('products'))->render();
        }

        return view('site.com.wonder-store', compact('products', 'categories', 'settings', 'contents'));
    }
}
