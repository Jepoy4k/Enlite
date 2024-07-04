<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>EnLite Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .container {
            display: flex;
            align-items: center;
            width: 80%;
            max-width: 800px;
            justify-content: space-between;
        }

        .login-logo {
            flex: 1;
            text-align: center;
            cursor: pointer;
        }

        .login-logo img {
            max-width: 100%;
            height: 100%;
            width: 100%;
        }

        .login-form {
            flex: 1;
            color: #fff;
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            margin-left: 70px;
            align-items: flex-start;
            background: #0A2656;
            padding: 50px;
            border-radius: 20px;
            backdrop-filter: blur(10px);
        }

        .login-form label {
            color: #fff;
            font-size: 16px;
            margin-bottom: 5px;
        }

        .login-form input {
            width: 90%;
            padding: 15px;
            margin-bottom: 10px;
            border: none;
            border-radius: 4px;
            background-color: #fff;
            font-size: 16px;
        }

        .login-form button {
            width: 250px;
            padding: 15px;
            background-color: #FFC619;
            border: none;
            border-radius: 8px;
            color: #000;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 2.1rem;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .login-form .password-toggle {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .login-form .password-toggle input {
            flex-grow: 1;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="login-logo">
            <img src="{{ asset('logo.png') }}" alt="EnLite Logo">
        </div>
        <div class="login-form">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Email Address" required>
                <label for="password">Password</label>
                <div class="password-toggle">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>