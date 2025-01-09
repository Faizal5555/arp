<!-- resources/views/emails/doctor_notification.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Email</title>
    <style>
        /* Main container styling */
        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            color: #333;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        /* Header styling */
        .email-header {
            background-color: #0b5dbb;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        /* Body content styling */
        .email-body {
            padding: 20px;
            background-color: #ffffff;
            line-height: 1.6;
            color: #333;
        }

        /* Footer styling */
        .email-footer {
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #777;
            background-color: #f9f9f9;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        /* Button styling */
        .action-button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            color: white;
            background-color: #405cf5;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            font-size: 16px;
        }

        .action-button:hover {
            background-color: #334fbb;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Email Header -->
        <!-- Email Body Content -->
        <div class="email-body">
            <p>Dear {{ $doctor->firstname }},</p>
            <p>{!! $emailContent !!}</p>
        </div>

        <!-- Email Footer -->
        <div class="email-footer">
            &copy; 2024 Asia Research Partners | All Rights Reserved
        </div>
    </div>
</body>
</html>
