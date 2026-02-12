<!DOCTYPE html>
<html>

<head>
    <title>New Appointment Request</title>
    <style>
        body {
            font-family: sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            background: #044A80;
            color: #fff;
            padding: 10px 20px;
            border-radius: 10px 10px 0 0;
        }

        .content {
            padding: 20px;
        }

        .footer {
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            text-align: center;
        }

        .label {
            font-weight: bold;
            color: #044A80;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Appointment Request</h2>
        </div>
        <div class="content">
            <p><span class="label">Name:</span> {{ $data['name'] }}</p>
            <p><span class="label">Email:</span> {{ $data['email'] }}</p>
            <p><span class="label">Phone:</span> {{ $data['phone'] }}</p>
            <p><span class="label">Date:</span> {{ $data['date'] }}</p>
            <p><span class="label">Time:</span> {{ $data['time'] }}</p>
            <p><span class="label">Subject:</span> {{ $data['subject'] }}</p>
            <p><span class="label">Message:</span></p>
            <p>{{ $data['message'] }}</p>
        </div>
        <div class="footer">
            Sent from Your Wonderful Project (Workplace Well-being)
        </div>
    </div>
</body>

</html>