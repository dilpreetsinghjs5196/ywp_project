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

        return view('site.com.home', compact('settings', 'contents'));
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
}
