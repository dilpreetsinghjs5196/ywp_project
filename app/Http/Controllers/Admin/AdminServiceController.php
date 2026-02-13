<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable',
            'icon_image' => 'nullable|image',
            'description' => 'required',
            'goals' => 'nullable',
            'image' => 'nullable|image',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image', 'icon_image']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        }

        if ($request->hasFile('icon_image')) {
            $data['icon_image'] = $request->file('icon_image')->store('uploads/services/icons', 'public');
        }

        Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'icon' => 'nullable',
            'icon_image' => 'nullable|image',
            'description' => 'required',
            'goals' => 'nullable',
            'image' => 'nullable|image',
            'sort_order' => 'nullable|integer',
        ]);

        $data = $request->except(['image', 'icon_image']);
        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($service->image && !Str::startsWith($service->image, 'image/')) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        }

        if ($request->hasFile('icon_image')) {
            // Delete old icon
            if ($service->icon_image && !Str::startsWith($service->icon_image, 'image/')) {
                Storage::disk('public')->delete($service->icon_image);
            }
            $data['icon_image'] = $request->file('icon_image')->store('uploads/services/icons', 'public');
        }

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->image && !Str::startsWith($service->image, 'image/')) {
            Storage::disk('public')->delete($service->image);
        }
        if ($service->icon_image && !Str::startsWith($service->icon_image, 'image/')) {
            Storage::disk('public')->delete($service->icon_image);
        }
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}
