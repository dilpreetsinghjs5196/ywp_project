<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeHeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHomeHeroSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = HomeHeroSlide::orderBy('order', 'asc')->get();
        return view('admin.home_hero_slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home_hero_slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp,gif',
            'order' => 'integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/hero', 'public');
        }

        HomeHeroSlide::create($data);

        return redirect()->route('admin.home-hero-slides.index')->with('success', 'Hero slide created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeHeroSlide $home_hero_slide)
    {
        $slide = $home_hero_slide;
        return view('admin.home_hero_slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeHeroSlide $home_hero_slide)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:2048',
            'order' => 'integer',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($home_hero_slide->image) {
                Storage::disk('public')->delete($home_hero_slide->image);
            }
            $data['image'] = $request->file('image')->store('uploads/hero', 'public');
        }

        $home_hero_slide->update($data);

        return redirect()->route('admin.home-hero-slides.index')->with('success', 'Hero slide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeHeroSlide $home_hero_slide)
    {
        if ($home_hero_slide->image) {
            Storage::disk('public')->delete($home_hero_slide->image);
        }
        $home_hero_slide->delete();

        return redirect()->route('admin.home-hero-slides.index')->with('success', 'Hero slide deleted successfully.');
    }
}
