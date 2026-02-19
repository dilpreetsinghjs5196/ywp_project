<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;

class AdminTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Team::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('designation', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $teams = $query->orderBy('sort_order')->paginate(10)->withQueryString();
        $bookingSettings = \App\Models\SiteSetting::where('group', 'booking')->get()->pluck('value', 'key');

        if ($request->ajax()) {
            return view('admin.teams._table', compact('teams'))->render();
        }

        return view('admin.teams.index', compact('teams', 'bookingSettings'));
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
        $data = $request->except(['image', 'availability']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        if ($request->has('availability')) {
            $formattedAvailability = [];
            foreach ($request->availability as $date => $times) {
                if (!empty($times)) {
                    $timeArray = array_map('trim', explode(',', $times));
                    $formattedAvailability[$date] = $timeArray;
                }
            }
            $data['availability'] = $formattedAvailability;
        }

        if ($request->has('weekly_availability')) {
            $formattedWeekly = [];
            foreach ($request->weekly_availability as $day => $times) {
                if (!empty($times)) {
                    $timeArray = array_map('trim', explode(',', $times));
                    $formattedWeekly[$day] = $timeArray;
                }
            }
            $data['weekly_availability'] = $formattedWeekly;
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
        $data = $request->except(['image', 'availability']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            // Delete old image if not a default one
            if ($team->image && !\Illuminate\Support\Str::startsWith($team->image, 'image/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        if ($request->has('availability')) {
            $formattedAvailability = [];
            foreach ($request->availability as $date => $times) {
                if (!empty($times)) {
                    $timeArray = array_map('trim', explode(',', $times));
                    $formattedAvailability[$date] = $timeArray;
                }
            }
            $data['availability'] = $formattedAvailability;
        } else {
            $data['availability'] = null;
        }

        if ($request->has('weekly_availability')) {
            $formattedWeekly = [];
            foreach ($request->weekly_availability as $day => $times) {
                if (!empty($times)) {
                    $timeArray = array_map('trim', explode(',', $times));
                    $formattedWeekly[$day] = $timeArray;
                }
            }
            $data['weekly_availability'] = $formattedWeekly;
        } else {
            $data['weekly_availability'] = null;
        }

        $team->update($data);

        // Update the linked user's password if provided
        if ($request->filled('password') && $team->email) {
            $user = \App\Models\User::where('email', $team->email)->first();
            if ($user) {
                $user->update([
                    'password' => \Illuminate\Support\Facades\Hash::make($request->password)
                ]);
            }
        }

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
