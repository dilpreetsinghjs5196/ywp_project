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

        return view('site.com.about', compact('settings', 'contents'));
    }

    public function team()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $teams = \App\Models\Team::where('is_active', true)->orderBy('sort_order')->get();

        return view('site.com.team', compact('settings', 'teams'));
    }
}
