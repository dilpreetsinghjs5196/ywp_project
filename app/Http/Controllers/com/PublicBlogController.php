<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogTheme;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PublicBlogController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $themes = BlogTheme::with([
            'blogs' => function ($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }
        ])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('site.com.blogs.index', compact('settings', 'themes'));
    }

    public function show($slug)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $blog = Blog::with('theme')->where('slug', $slug)->where('is_active', true)->firstOrFail();

        $relatedBlogs = Blog::where('blog_theme_id', $blog->blog_theme_id)
            ->where('id', '!=', $blog->id)
            ->where('is_active', true)
            ->limit(3)
            ->get();

        return view('site.com.blogs.show', compact('settings', 'blog', 'relatedBlogs'));
    }
}
