<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with('theme');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $blogs = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.blogs._table', compact('blogs'))->render();
        }

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $themes = BlogTheme::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blogs.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_theme_id' => 'required|exists:blog_themes,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
        ]);

        try {
            $data = $request->except(['image']);
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/blogs', $filename, 'public');
                $data['image'] = $path;
            }

            Blog::create($data);

            return redirect()->route('admin.blogs.index')->with('success', 'Blog post added successfully.');
        } catch (\Exception $e) {
            \Log::error('Blog Store Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to create blog post. ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $themes = BlogTheme::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blogs.edit', compact('blog', 'themes'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'blog_theme_id' => 'required|exists:blog_themes,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'summary' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order' => 'nullable|integer',
            'published_at' => 'nullable|date',
        ]);

        try {
            $data = $request->except(['image']);
            $data['is_active'] = $request->has('is_active');

            $blog->fill($data);

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/blogs', $filename, 'public');

                // Delete old image if it exists and is not a default path
                if ($blog->image && !Str::startsWith($blog->image, 'image/')) {
                    Storage::disk('public')->delete($blog->image);
                }

                $blog->image = $path;
            }

            $blog->save();

            return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Blog Update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update blog post. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image && !Str::startsWith($blog->image, 'image/')) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully.');
    }
}
