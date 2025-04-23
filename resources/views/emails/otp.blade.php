<head>
    <meta charset="UTF-8">
    <title>Your OTP Code</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 40px;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: #333333;">🔐 Verify Your Account</h2>
        <p style="font-size: 16px; color: #555555;">
            Hello {{ $name ?? 'User' }},
        </p>
        <p style="font-size: 16px; color: #555555;">
            Your One-Time Password (OTP) for verifying your account is:
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <span style="font-size: 28px; letter-spacing: 6px; font-weight: bold; color: #2c3e50;">{{ $otp }}</span>
        </div>

        <p style="font-size: 14px; color: #888888;">
            This OTP is valid for the next <strong>5 minutes</strong>. Do not share this code with anyone.
        </p>

        <p style="font-size: 14px; color: #888888;">
            If you did not request this code, please ignore this email.
        </p>

        <hr style="margin: 30px 0; border: none; border-top: 1px solid #dddddd;">
        <p style="text-align: center; font-size: 12px; color: #aaaaaa;">
            &copy; {{ date('Y') }} YourApp. All rights reserved.
        </p>
    </div>
</body>

</html>