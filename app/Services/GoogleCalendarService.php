<?php

namespace App\Services;

use App\Models\SiteSetting;
use App\Models\Team;
use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\FreeBusyRequest;
use Google\Service\Calendar\FreeBusyRequestItem;
use Carbon\Carbon;

class GoogleCalendarService
{
    protected $client;

    public function __construct()
    {
        $clientId = SiteSetting::where('key', 'google_client_id')->first()->value;
        $clientSecret = SiteSetting::where('key', 'google_client_secret')->first()->value;

        $this->client = new Client();
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
    }

    /**
     * Get a configured Google Client for a specific therapist.
     */
    protected function getClientForTherapist(Team $therapist)
    {
        if (!$therapist->google_access_token) {
            return null;
        }

        $this->client->setAccessToken([
            'access_token' => $therapist->google_access_token,
            'refresh_token' => $therapist->google_refresh_token,
            'expires_in' => Carbon::now()->diffInSeconds($therapist->google_token_expires_at, false),
            'created' => $therapist->updated_at->timestamp
        ]);

        if ($this->client->isAccessTokenExpired()) {
            if ($therapist->google_refresh_token) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken($therapist->google_refresh_token);

                if (isset($newToken['error'])) {
                    return null;
                }

                $therapist->update([
                    'google_access_token' => $newToken['access_token'],
                    'google_token_expires_at' => Carbon::now()->addSeconds($newToken['expires_in'])
                ]);
            } else {
                return null;
            }
        }

        return $this->client;
    }

    /**
     * Create an event on the therapist's calendar.
     */
    public function createEvent(Team $therapist, array $details)
    {
        $client = $this->getClientForTherapist($therapist);
        if (!$client)
            return false;

        $service = new Calendar($client);

        $event = new Event([
            'summary' => 'Therapy Session: ' . $details['client_name'],
            'location' => $details['location'] ?? 'Online (Link will be shared)',
            'description' => "Client Name: {$details['client_name']}\nEmail: {$details['client_email']}\nPhone: {$details['client_phone']}\n\nNote: This session was booked via YWP Portal.",
            'start' => [
                'dateTime' => $details['start_time'], // ISO 8601
                'timeZone' => 'Asia/Kolkata',
            ],
            'end' => [
                'dateTime' => $details['end_time'],
                'timeZone' => 'Asia/Kolkata',
            ],
            'reminders' => [
                'useDefault' => FALSE,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 30],
                ],
            ],
        ]);

        $calendarId = $therapist->google_calendar_id ?: 'primary';
        $service->events->insert($calendarId, $event);

        return true;
    }

    /**
     * Get busy slots for a therapist on a specific date.
     */
    public function getBusySlots(Team $therapist, $date)
    {
        $client = $this->getClientForTherapist($therapist);
        if (!$client)
            return [];

        $service = new Calendar($client);

        $startTime = Carbon::parse($date)->startOfDay()->toIso8601String();
        $endTime = Carbon::parse($date)->endOfDay()->toIso8601String();

        $request = new FreeBusyRequest();
        $request->setTimeMin($startTime);
        $request->setTimeMax($endTime);
        $request->setTimeZone('Asia/Kolkata');

        $item = new FreeBusyRequestItem();
        $item->setId($therapist->google_calendar_id ?: 'primary');
        $request->setItems([$item]);

        $query = $service->freebusy->query($request);
        $busySlots = $query->getCalendars()[$therapist->google_calendar_id ?: 'primary']->getBusy();

        $formatted = [];
        foreach ($busySlots as $slot) {
            $formatted[] = [
                'start' => Carbon::parse($slot->getStart())->setTimezone('Asia/Kolkata')->format('H:i'),
                'end' => Carbon::parse($slot->getEnd())->setTimezone('Asia/Kolkata')->format('H:i')
            ];
        }

        return $formatted;
    }
}
