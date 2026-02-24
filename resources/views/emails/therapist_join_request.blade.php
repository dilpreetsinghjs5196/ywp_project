@component('mail::message')
# New Therapist Application

You have received a new therapist application from the website.

**Name:** {{ $data['name'] }}
**Email:** {{ $data['email'] }}
**Phone:** {{ $data['phone'] }}
**Specialization:** {{ $data['specialization'] }}
**Experience:** {{ $data['experience'] }}

**Message:**
{{ $data['message'] ?? 'No message provided' }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent