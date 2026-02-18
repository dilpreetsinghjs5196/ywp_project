<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            if ($request->is('admin/*') || $request->is('admin')) {
                return redirect()->route('admin.login');
            }
            return redirect()->route('login');
        }

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                return $next($request);
            }
        }

        // Redirect to respective dashboard if they have a known role but not the required one
        if ($request->user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard')->with('error', 'You do not have permission to access that section.');
        }
        if ($request->user()->hasRole('therapist')) {
            return redirect()->route('therapist.dashboard')->with('error', 'You do not have permission to access that section.');
        }

        abort(403, 'Unauthorized action.');
    }
}
