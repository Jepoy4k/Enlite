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

        .alert {
            width: 90%;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            background-color: #f8d7da;
            color: red;
            border: 1px solid #f5c6cb;
        }
        @media (max-width: 360px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .login-form {
                margin-left: 0;
                width: 90%;
                padding: 20px;
            }
            .login-form button {
                margin-left: 0;
                width: 100%;
            }
        }

        @media (min-width: 361px) and (max-width: 720px) {
            .container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .login-form {
                margin-left: 0;
                margin-right: 0;
                width: 60%;
                padding: 20px;
            }
            .login-form button {
                margin-left: 0;
                width: 40%;
            }
        }

        @media (min-width: 721px) and (max-width: 1366px) {
            .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .login-form {
                margin-left: 20px;
                width: 100%;
                padding: 38px;
            }

            .login-form button {
                margin-left: 3.3rem;
                width: 60%;
            }
        }

        @media (min-width: 1367px) and (max-width: 1920px) {
            .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .login-form {
                margin-left: 30px;
                width: 70%;
                padding: 50px;
            }
            .login-form button {
                margin-left: 4rem;
                width: 60%;
            }
        }

        @media (min-width: 1921px) {
            .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .login-form {
                margin-left: 40px;
                width: 75%;
                padding: 50px;
            }
            .login-form button {
                margin-left: 4rem;
                width: 60%;
            }
        }

        @media (min-width: 1440px) and (max-width: 1919px) {
            .container {
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .login-form {
                display: center;
                margin-left: 30px;
                width: 75%;
                padding: 50px;
            }
            .login-form button {
                margin-left: 4rem;
                width: 60%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-logo">
            <img src="{{ asset('logo.png') }}" alt="EnLite Logo">
        </div>
        <div class="login-form">
            <!-- @if($errors->any())
                <div class="alert">
                    {{ $errors->first() }}
                </div>
            @endif -->
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf
                <label for="email">Username</label>
                <input type="text" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                <label for="password">Password</label>
                <div class="password-toggle">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                @if($errors->any())
                <div class="alert">
                    {{ $errors->first() }}
                </div>
            @endif
                <button type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>
