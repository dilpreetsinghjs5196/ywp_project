<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBrandController extends Controller
{
    public function index(Request $request)
    {
        $query = Brand::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $brands = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.brands._table', compact('brands'))->render();
        }

        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/brands', 'public');
        }

        Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);

        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if not a default one
            if ($brand->image && !Str::startsWith($brand->image, 'image/')) {
                Storage::disk('public')->delete($brand->image);
            }
            $data['image'] = $request->file('image')->store('uploads/brands', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->image && !Str::startsWith($brand->image, 'image/')) {
            Storage::disk('public')->delete($brand->image);
        }
        $brand->delete();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
