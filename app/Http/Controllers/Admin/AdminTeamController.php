<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('sort_order')->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.teams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        Team::create($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team member added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data = $request->except(['image']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if not a default one
            if ($team->image && !\Illuminate\Support\Str::startsWith($team->image, 'image/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        $team->update($data);

        return redirect()->route('admin.teams.index')->with('success', 'Team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if ($team->image && !\Illuminate\Support\Str::startsWith($team->image, 'image/')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
        }
        $team->delete();

        return redirect()->route('admin.teams.index')->with('success', 'Team member deleted successfully.');
    }
}
