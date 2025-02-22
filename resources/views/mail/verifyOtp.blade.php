<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="{{ route('verifyOtp') }}">
        @csrf
        <label for="otp">Enter OTP</label>
        <input type="text" name="otp" required>
    
        <button type="submit">Verify OTP</button>
    </form>
    
</body>
</html>