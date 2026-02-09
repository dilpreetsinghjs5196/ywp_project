<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WonderStoreCategory;

class AdminWonderStoreCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = WonderStoreCategory::latest()->get();
        return view('admin.wonder_store.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.wonder_store.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:wonder_store_categories,category_name',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        WonderStoreCategory::create($data);

        return redirect()->route('admin.wonder-store-categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WonderStoreCategory $wonderStoreCategory)
    {
        return view('admin.wonder_store.categories.edit', compact('wonderStoreCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WonderStoreCategory $wonderStoreCategory)
    {
        $request->validate([
            'category_name' => 'required|max:255|unique:wonder_store_categories,category_name,' . $wonderStoreCategory->id,
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');

        $wonderStoreCategory->update($data);

        return redirect()->route('admin.wonder-store-categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WonderStoreCategory $wonderStoreCategory)
    {
        $wonderStoreCategory->delete();

        return redirect()->route('admin.wonder-store-categories.index')->with('success', 'Category deleted successfully.');
    }
}
