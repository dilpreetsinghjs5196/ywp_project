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
        $contents = PageContent::where('page', 'team')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        $teams = \App\Models\Team::where('is_active', true)->orderBy('sort_order')->paginate(4);

        return view('site.com.team', compact('settings', 'contents', 'teams'));
    }

    public function teamSingle($id)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $team = \App\Models\Team::where('is_active', true)->findOrFail($id);
        $recentTeams = \App\Models\Team::where('is_active', true)->where('id', '!=', $id)->orderBy('sort_order')->take(3)->get();
        $reviews = $team->approvedReviews()->orderBy('created_at', 'desc')->get();

        return view('site.com.team_single', compact('settings', 'team', 'recentTeams', 'reviews'));
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

    public function therapistBooking($id)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $team = \App\Models\Team::with('services')->where('is_active', true)->findOrFail($id);

        return view('site.com.booking', compact('settings', 'team'));
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

    public function services()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $contents = PageContent::where('page', 'services')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        // If no content for services page, try to get some defaults or from other pages if needed
        // For now, let's also fetch about page content for the "Therapy Process" section
        $aboutContents = PageContent::where('page', 'about')
            ->get()
            ->groupBy('section')
            ->map(function ($section) {
                return $section->pluck('value', 'key');
            });

        if (!isset($contents['consult'])) {
            $contents['consult'] = $aboutContents['consult'] ?? collect();
        }
        if (!isset($contents['steps'])) {
            $contents['steps'] = $aboutContents['steps'] ?? collect();
        }

        $services = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.services', compact('settings', 'contents', 'services'));
    }

    public function serviceTherapists($slug)
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $service = \App\Models\Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $teams = $service->therapists()->where('is_active', true)->orderBy('sort_order')->paginate(4);

        return view('site.com.service_therapists', compact('settings', 'service', 'teams'));
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
