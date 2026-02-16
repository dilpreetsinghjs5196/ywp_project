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
    public function index(Request $request)
    {
        $query = User::with('roles');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        $users = $query->paginate(10)->withQueryString();

        $userEmails = User::pluck('email')->toArray();
        $unregisteredTeamMembers = Team::whereNotNull('email')
            ->whereNotIn('email', $userEmails)
            ->get();

        if ($request->ajax()) {
            return view('admin.users._table', compact('users', 'unregisteredTeamMembers'))->render();
        }

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
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->roles()->sync($request->roles);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
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
