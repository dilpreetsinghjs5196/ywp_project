<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SiteSetting;

class AdminSettingController extends Controller
{
    public function branding()
    {
        $settings = SiteSetting::where('group', 'branding')->get();
        return view('admin.settings.branding', compact('settings'));
    }

    public function contact()
    {
        $settings = SiteSetting::whereIn('group', ['contact', 'footer'])->get();
        return view('admin.settings.contact', compact('settings'));
    }

    public function mail()
    {
        $settings = SiteSetting::where('group', 'smtp')->get();
        return view('admin.settings.mail', compact('settings'));
    }

    public function google()
    {
        $settings = SiteSetting::where('group', 'google')->get();
        return view('admin.settings.google', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except(['_token']);

        foreach ($data as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();
            if ($setting) {
                if ($setting->type === 'image' && $request->hasFile($key)) {
                    $path = $request->file($key)->store('uploads/branding', 'public');
                    $setting->update(['value' => $path]);
                } else {
                    $setting->update(['value' => $value]);
                }
            }
        }

        return back()->with('success', 'Settings updated successfully.');
    }
}
