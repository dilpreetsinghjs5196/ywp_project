<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminVideoThemeController extends Controller
{
    public function index(Request $request)
    {
        $query = VideoTheme::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $themes = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        return view('admin.video_themes.index', compact('themes'));
    }

    public function create()
    {
        return view('admin.video_themes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:video_themes,slug',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            VideoTheme::create($data);

            return redirect()->route('admin.video-themes.index')->with('success', 'Video Theme added successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add video theme. ' . $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $theme = VideoTheme::findOrFail($id);
        return view('admin.video_themes.edit', compact('theme'));
    }

    public function update(Request $request, $id)
    {
        $theme = VideoTheme::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:video_themes,slug,' . $id,
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $data = $request->all();
            $data['is_active'] = $request->has('is_active');

            $theme->update($data);

            return redirect()->route('admin.video-themes.index')->with('success', 'Video Theme updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update video theme. ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $theme = VideoTheme::findOrFail($id);
        $theme->delete();

        return redirect()->route('admin.video-themes.index')->with('success', 'Video Theme deleted successfully.');
    }
}
