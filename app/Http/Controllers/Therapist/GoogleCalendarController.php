<?php

namespace App\Http\Controllers\Therapist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use App\Models\Team;
use Illuminate\Support\Facades\Auth;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Oauth2;

class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $clientId = SiteSetting::where('key', 'google_client_id')->first()->value;
        $clientSecret = SiteSetting::where('key', 'google_client_secret')->first()->value;

        if (!$clientId || !$clientSecret) {
            return back()->with('error', 'Google API credentials not configured by Administrator.');
        }

        $client = new Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri(route('therapist.google.callback'));
        $client->addScope(Calendar::CALENDAR_EVENTS);
        $client->addScope(Calendar::CALENDAR_READONLY);
        $client->addScope('profile');
        $client->addScope('email');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        return redirect()->away($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('error')) {
            return redirect()->route('therapist.profile')->with('error', 'Google connection cancelled.');
        }

        $clientId = SiteSetting::where('key', 'google_client_id')->first()->value;
        $clientSecret = SiteSetting::where('key', 'google_client_secret')->first()->value;

        $client = new Client();
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri(route('therapist.google.callback'));

        try {
            $token = $client->fetchAccessTokenWithAuthCode($request->code);

            if (isset($token['error'])) {
                return redirect()->route('therapist.profile')->with('error', 'Failed to fetch access token: ' . $token['error_description']);
            }

            $client->setAccessToken($token);

            $oauth2 = new Oauth2($client);
            $googleUser = $oauth2->userinfo->get();

            $therapist = Team::where('email', Auth::user()->email)->first();

            $therapist->update([
                'google_id' => $googleUser->id,
                'google_access_token' => $token['access_token'],
                'google_refresh_token' => $token['refresh_token'] ?? $therapist->google_refresh_token,
                'google_token_expires_at' => now()->addSeconds($token['expires_in']),
                'google_calendar_id' => 'primary'
            ]);

            return redirect()->route('therapist.profile')->with('success', 'Google Calendar connected successfully!');

        } catch (\Exception $e) {
            return redirect()->route('therapist.profile')->with('error', 'Error connecting Google Calendar: ' . $e->getMessage());
        }
    }
}
