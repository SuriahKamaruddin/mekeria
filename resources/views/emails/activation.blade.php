<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}!</h1>
    <p>Thank you for registering with mekeria. Please click the link below to activate your account:</p>
    <a href="{{ $activationLink }}">Activate Account</a>
    <p>If you did not register, please ignore this email.</p>
</body>
</html>
