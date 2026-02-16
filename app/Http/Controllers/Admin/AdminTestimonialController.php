<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Http\Requests\StoreTestimonialRequest;
use App\Http\Requests\UpdateTestimonialRequest;

class AdminTestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Testimonial::query();

        if ($request->filled('search')) {
            $query->where('client_name', 'like', '%' . $request->search . '%')
                ->orWhere('feedback', 'like', '%' . $request->search . '%')
                ->orWhere('designation', 'like', '%' . $request->search . '%');
        }

        $testimonials = $query->orderBy('sort_order')->paginate(10)->withQueryString();

        if ($request->ajax()) {
            return view('admin.testimonials._table', compact('testimonials'))->render();
        }

        return view('admin.testimonials.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestimonialRequest $request)
    {
        $data = $request->except(['client_image']);

        if ($request->hasFile('client_image')) {
            $data['client_image'] = $request->file('client_image')->store('uploads/testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestimonialRequest $request, Testimonial $testimonial)
    {
        $data = $request->except(['client_image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('client_image')) {
            if ($testimonial->client_image && !\Illuminate\Support\Str::startsWith($testimonial->client_image, 'image/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->client_image);
            }
            $data['client_image'] = $request->file('client_image')->store('uploads/testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->client_image && !\Illuminate\Support\Str::startsWith($testimonial->client_image, 'image/')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->client_image);
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
