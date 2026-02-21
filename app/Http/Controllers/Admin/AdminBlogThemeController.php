<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminBlogThemeController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogTheme::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $themes = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.blog_themes._table', compact('themes'))->render();
        }

        return view('admin.blog_themes.index', compact('themes'));
    }

    public function create()
    {
        return view('admin.blog_themes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_themes,slug',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            BlogTheme::create($data);

            return redirect()->route('admin.blog-themes.index')->with('success', 'Blog Theme added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add theme. ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $theme = BlogTheme::findOrFail($id);
        return view('admin.blog_themes.edit', compact('theme'));
    }

    public function update(Request $request, $id)
    {
        $theme = BlogTheme::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_themes,slug,' . $id,
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            $theme->update($data);

            return redirect()->route('admin.blog-themes.index')->with('success', 'Blog Theme updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update theme. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $theme = BlogTheme::findOrFail($id);
        $theme->delete();

        return redirect()->route('admin.blog-themes.index')->with('success', 'Blog Theme deleted successfully.');
    }
}
