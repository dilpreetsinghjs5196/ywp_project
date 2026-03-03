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
        $services = \App\Models\Service::where('is_active', true)->get();
        return view('admin.teams.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request)
    {
        $data = $request->except(['image', 'availability']);
        $data['commission_percentage'] = $request->commission_percentage ?? 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        if ($request->has('availability')) {
            $formattedAvailability = [];
            foreach ($request->availability as $serviceId => $dates) {
                if (is_array($dates)) {
                    foreach ($dates as $date => $modes) {
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_map('trim', explode(',', $times));
                                    $formattedAvailability[$serviceId][$date][$mode] = $timeArray;
                                }
                            }
                        }
                    }
                }
            }
            $data['availability'] = $formattedAvailability;
        }

        if ($request->has('weekly_availability')) {
            $formattedWeekly = [];
            foreach ($request->weekly_availability as $serviceId => $days) {
                if (is_array($days)) {
                    foreach ($days as $day => $modes) {
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_map('trim', explode(',', $times));
                                    $formattedWeekly[$serviceId][$day][$mode] = $timeArray;
                                }
                            }
                        }
                    }
                }
            }
            $data['weekly_availability'] = $formattedWeekly;
        }

        if ($request->has('weekly_addresses')) {
            $data['weekly_addresses'] = array_filter($request->weekly_addresses);
        }

        if ($request->has('date_addresses')) {
            $data['date_addresses'] = array_filter($request->date_addresses);
        }

        $team = Team::create($data);

        if ($request->has('services')) {
            $syncData = [];
            foreach ($request->services as $serviceId) {
                $syncData[$serviceId] = [
                    'fees' => $request->service_fees[$serviceId] ?? null,
                    'duration' => $request->service_durations[$serviceId] ?? null
                ];
            }
            $team->services()->sync($syncData);
        }

        return redirect()->route('admin.teams.index')->with('success', 'Team member added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        $services = \App\Models\Service::where('is_active', true)->get();
        $assignedServices = $team->services->mapWithKeys(function ($s) {
            return [
                $s->id => [
                    'fees' => $s->pivot->fees,
                    'duration' => $s->pivot->duration
                ]
            ];
        })->toArray();
        return view('admin.teams.edit', compact('team', 'services', 'assignedServices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $data = $request->except(['image', 'availability']);
        $data['is_active'] = $request->has('is_active');
        $data['commission_percentage'] = $request->commission_percentage ?? 0;

        if ($request->hasFile('image')) {
            // Delete old image if not a default one
            if ($team->image && !\Illuminate\Support\Str::startsWith($team->image, 'image/')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($team->image);
            }
            $data['image'] = $request->file('image')->store('uploads/teams', 'public');
        }

        if ($request->has('availability')) {
            $formattedAvailability = [];
            foreach ($request->availability as $serviceId => $dates) {
                if (is_array($dates)) {
                    foreach ($dates as $date => $modes) {
                        // Initialize date entry to allow 'blocked' days (overrides)
                        if (!isset($formattedAvailability[$serviceId][$date])) {
                            $formattedAvailability[$serviceId][$date] = [];
                        }
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_filter(array_map('trim', explode(',', $times)));
                                    if (!empty($timeArray)) {
                                        $formattedAvailability[$serviceId][$date][$mode] = $timeArray;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data['availability'] = $formattedAvailability;
        } else {
            $data['availability'] = null;
        }

        if ($request->has('weekly_availability')) {
            $formattedWeekly = [];
            foreach ($request->weekly_availability as $serviceId => $days) {
                if (is_array($days)) {
                    foreach ($days as $day => $modes) {
                        if (is_array($modes)) {
                            foreach ($modes as $mode => $times) {
                                if (!empty($times)) {
                                    $timeArray = array_filter(array_map('trim', explode(',', $times)));
                                    if (!empty($timeArray)) {
                                        $formattedWeekly[$serviceId][$day][$mode] = $timeArray;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $data['weekly_availability'] = $formattedWeekly;
        } else {
            $data['weekly_availability'] = null;
        }

        if ($request->has('weekly_addresses')) {
            $data['weekly_addresses'] = array_filter($request->weekly_addresses);
        } else {
            $data['weekly_addresses'] = null;
        }

        if ($request->has('date_addresses')) {
            $data['date_addresses'] = array_filter($request->date_addresses);
        } else {
            $data['date_addresses'] = null;
        }

        $team->update($data);

        if ($request->has('services')) {
            $syncData = [];
            foreach ($request->services as $serviceId) {
                $syncData[$serviceId] = [
                    'fees' => $request->service_fees[$serviceId] ?? null,
                    'duration' => $request->service_durations[$serviceId] ?? null
                ];
            }
            $team->services()->sync($syncData);
        } else {
            $team->services()->detach();
        }

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
