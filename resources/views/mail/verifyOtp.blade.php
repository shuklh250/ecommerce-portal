<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            display: flex;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            width: 100%;
        }

        .image-section {
            flex: 1;
            background: url('https://cdn.pixabay.com/photo/2020/06/22/10/30/email-5324165_1280.png') center/cover no-repeat;
        }

        .form-section {
            flex: 1;
            padding: 40px;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .alert {
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .image-section {
                height: 200px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="image-section"></div>

        <div class="form-section">
            <h2>OTP Verification</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('Error'))
                <div class="alert alert-danger">
                    {{ session('Error') }}
                </div>
            @endif

            @if ($errors->has('otp'))
                <div class="alert alert-danger">
                    {{ $errors->first('otp') }}
                </div>
            @endif

            <form method="POST" action="{{ route('verifyOtp') }}">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user_email }}">
                <label for="otp">Enter OTP</label>
                <input type="text" name="otp" id="otp" required placeholder="Enter your 6-digit OTP">

                <button type="submit">Verify OTP</button>
            </form>
        </div>
    </div>

</body>

</html>