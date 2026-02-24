<!DOCTYPE html>
<html>

<head>
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            max-height: 50px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            background-color: #f0fdf4;
            color: #166534;
            margin-bottom: 20px;
        }

        h2 {
            color: #044A80;
            margin-top: 0;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin: 30px 0;
            padding: 20px;
            background-color: #fdfdfd;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .value {
            font-size: 16px;
            font-weight: 600;
            color: #0f172a;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #64748b;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            background-color: #044A80;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2 style="color: #ffbf00; margin-bottom: 5px;">YWP Booking</h2>
            <div class="status-badge">Payment Received • Confirmed</div>
        </div>

        @if($recipientType == 'admin')
            <p>Hello Admin,</p>
            <p>A new therapy session has been booked and paid for. Here are the details:</p>
        @elseif($recipientType == 'therapist')
            <p>Hello {{ $booking->therapist->name }},</p>
            <p>You have a new session booking. Please review the details below:</p>
        @else
            <p>Dear {{ $booking->name }},</p>
            <p>Your session with <strong>{{ $booking->therapist->name }}</strong> has been confirmed! We look forward to
                seeing you.</p>
        @endif

        <div class="details-grid">
            <div>
                <div class="label">Patient Name</div>
                <div class="value">{{ $booking->name }}</div>
            </div>
            <div>
                <div class="label">Gender</div>
                <div class="value">{{ $booking->gender }}</div>
            </div>
            <div>
                <div class="label">City/Location</div>
                <div class="value">{{ $booking->location }}</div>
            </div>
            <div>
                <div class="label">Therapist</div>
                <div class="value">{{ $booking->therapist->name }}</div>
            </div>
            <div>
                <div class="label">Date</div>
                <div class="value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('l, M d, Y') }}</div>
            </div>
            <div>
                <div class="label">Time Slot</div>
                <div class="value">{{ $booking->booking_time }}</div>
            </div>
            <div>
                <div class="label">Session Mode</div>
                <div class="value">{{ $booking->mode }}</div>
            </div>
            <div>
                <div class="label">Amount Paid</div>
                <div class="value">₹{{ number_format($booking->amount, 2) }}</div>
            </div>
        </div>

        <div style="margin-top: 30px; padding: 20px; border-left: 4px solid #ffbf00; background-color: #fffbeb;">
            <div class="label">Contact Information</div>
            <div class="value">{{ $booking->email }}</div>
            <div class="value">{{ $booking->phone }}</div>
            @if($booking->message)
                <div class="label" style="margin-top: 15px;">Message from Patient</div>
                <p style="margin: 0; font-size: 14px;">{{ $booking->message }}</p>
            @endif
        </div>

        <div class="footer">
            <p>This is an automated message. Please do not reply directly to this email.</p>
            <p>&copy; {{ date('Y') }} Your Wonderful Project. All rights reserved.</p>
        </div>
    </div>
</body>

</html>