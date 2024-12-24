<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Activation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333333;
            text-align: center;
        }

        p {
            font-size: 16px;
            color: #555555;
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
        }

        .button {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 18px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #888888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>You are receiving this email because we received a new registration on our website.</p>
        <br><br>
        <div class="button-container">
            <a href="{{ $activationLink }}" class="button">Activate my account</a>
        </div>
        <br><br>
        <p>Click the button to activate your account and enjoy ordering with Mekeria.</p>
        <p>Kindly ignore this email if you did not register with us.</p>
        <footer>
            <p>Regards, <br>Mekeria</p>
        </footer>
    </div>
</body>
</html>
