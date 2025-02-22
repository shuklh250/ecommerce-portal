<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
</head>
<body>
    <h3>Hello, Admin</h3>
    <p> name:{{ $request['name'] }}</p>
    <p>Email:{{ $request['email'] }}</p>
    <p>Subject:{{ $request['subject'] }}</p>
    <p>Message: {{ $request['message'] }}</p>
</body>
</html>