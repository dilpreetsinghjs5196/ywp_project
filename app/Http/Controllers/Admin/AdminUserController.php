<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Team;
use App\Models\Role;

use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);

        $userEmails = User::pluck('email')->toArray();
        $unregisteredTeamMembers = Team::whereNotNull('email')
            ->whereNotIn('email', $userEmails)
            ->get();

        return view('admin.users.index', compact('users', 'unregisteredTeamMembers'));
    }

    public function createFromTeam(Team $team)
    {
        if (!$team->email) {
            return back()->with('error', 'Team member must have an email address.');
        }

        if (User::where('email', $team->email)->exists()) {
            return back()->with('error', 'User already exists with this email.');
        }

        // Create the user
        $user = User::create([
            'name' => $team->name,
            'email' => $team->email,
            'password' => Hash::make('password123'), // Default temporary password
        ]);

        // Assign Therapist role
        $therapistRole = Role::where('slug', 'therapist')->first();
        if ($therapistRole) {
            $user->roles()->attach($therapistRole->id);
        }

        return redirect()->route('admin.users.index')->with('success', "Account created for {$team->name}. Default password is 'password123'.");
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'User roles updated successfully.');
    }

    public function destroy(User $user)
    {
        if ($user->email === 'akash@yourewonderfulproject.org') {
            return back()->with('error', 'The primary admin cannot be deleted.');
        }
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
