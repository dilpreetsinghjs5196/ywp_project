<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogVideo;
use App\Models\VideoTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBlogVideoController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogVideo::with('theme');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $videos = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        return view('admin.blog_videos.index', compact('videos'));
    }

    public function create()
    {
        $themes = VideoTheme::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blog_videos.create', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'video_theme_id' => 'required|exists:video_themes,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->except(['thumbnail']);
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/blog_videos', $filename, 'public');
                $data['thumbnail'] = $path;
            }

            BlogVideo::create($data);

            return redirect()->route('admin.blog-videos.index')->with('success', 'Blog video added successfully.');
        } catch (\Exception $e) {
            \Log::error('Blog Video Store Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to add blog video. ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $video = BlogVideo::findOrFail($id);
        $themes = VideoTheme::where('is_active', true)->orderBy('sort_order')->get();
        return view('admin.blog_videos.edit', compact('video', 'themes'));
    }

    public function update(Request $request, $id)
    {
        $video = BlogVideo::findOrFail($id);

        $request->validate([
            'video_theme_id' => 'required|exists:video_themes,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->except(['thumbnail']);
            $data['is_active'] = $request->has('is_active');

            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('uploads/blog_videos', $filename, 'public');
                $data['thumbnail'] = $path;

                if ($video->thumbnail) {
                    Storage::disk('public')->delete($video->thumbnail);
                }
            }

            $video->update($data);

            return redirect()->route('admin.blog-videos.index')->with('success', 'Blog video updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Blog Video Update Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to update blog video. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $video = BlogVideo::findOrFail($id);
        if ($video->thumbnail) {
            Storage::disk('public')->delete($video->thumbnail);
        }
        $video->delete();

        return redirect()->route('admin.blog-videos.index')->with('success', 'Blog video deleted successfully.');
    }
}
