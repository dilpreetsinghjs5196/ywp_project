<?php

namespace App\Http\Controllers\com;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiteSetting;
use App\Models\PageContent;

class HomeController extends Controller
{
    public function home()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'home')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        $services = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get();
        $teams = \App\Models\Team::where('is_active', true)->orderBy('sort_order')->get();
        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.home', compact('settings', 'contents', 'services', 'teams', 'testimonials'));
    }

    public function about()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'about')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        $teams = \App\Models\Team::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.about', compact('settings', 'contents', 'teams'));
    }

    public function team()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $teams = \App\Models\Team::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.team', compact('settings', 'teams'));
    }

    public function teamSingle($id)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $team = \App\Models\Team::where('is_active', true)->findOrFail($id);
        $recentTeams = \App\Models\Team::where('is_active', true)->where('id', '!=', $id)->orderBy('sort_order')->take(3)->get();

        return view('site.com.team_single', compact('settings', 'team', 'recentTeams'));
    }

    public function corporateWellBeing()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'corporate')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        $testimonials = \App\Models\Testimonial::where('is_active', true)->orderBy('sort_order')->get();
        $teams = \App\Models\Team::orderBy('sort_order')->get();
        $brands = \App\Models\Brand::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.corporate-well', compact('settings', 'contents', 'testimonials', 'teams', 'brands'));
    }

    public function contact()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');

        // Fetch content for the contact page
        $contents = PageContent::where('page', 'contact')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        // Sync 'get_in_touch' section from the home page
        $homeContents = PageContent::where('page', 'home')
            ->where('section', 'get_in_touch')
            ->get()
            ->pluck('value', 'key');

        if ($homeContents->isNotEmpty()) {
            $contents['get_in_touch'] = $homeContents;
        }

        return view('site.com.contact-us', compact('settings', 'contents'));
    }

    public function submitAppointment(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'subject' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $homeContents = PageContent::where('page', 'home')
            ->where('section', 'get_in_touch')
            ->get()
            ->pluck('value', 'key');

        $workplaceEmail = $homeContents['email'] ?? 'workplacewellbeingbyywp@gmail.com';
        $founderEmail = $homeContents['founder_email'] ?? 'akash@yourewonderfulproject.org';
        $tertiaryEmail = $homeContents['tertiary_email'] ?? 'info@yourewonderfulproject.org';

        try {
            // Save to Database
            \App\Models\Appointment::create($validated);

            \Illuminate\Support\Facades\Mail::to($workplaceEmail)
                ->cc([$founderEmail, $tertiaryEmail, $validated['email']])
                ->send(new \App\Mail\AppointmentMail($validated));

            return response()->json(['status' => 'success', 'message' => 'Email sent successfully.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
