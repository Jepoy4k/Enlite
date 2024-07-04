<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons.css">
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            height: 100%;
            width: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            width: 200px;
            background-color: #ffffff;
            color: #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            margin-top: 5rem; /* Margin for top bar */
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .sidebar ul li {
            text-align: left;
            transition: background-color 0.3s ease, color 0.3s ease;
            width: 100%;
            padding: 15px 20px;
            box-sizing: border-box;
        }

        .sidebar ul li.active {
            background-color: #FEC619;
            border-radius: 20px;
        }

        .sidebar ul li.active a {
            color: #000;
            font-weight: bold;
        }

        .sidebar ul li a {
            color: #000;
            text-decoration: none;
            display: block;
        }

        .mainmenu:hover {
            background-color: #FEC619; /* Hover Color */
            border-radius: 10px;
            padding: 15px 20px;
        }

        .submenu li:hover {
            background-color: #FEC619; /* Hover Color */
            border-radius: 20px;
        }

        .sidebar ul li:hover > a {
            color: #000;
        }

        .sidebar ul li ul {
            display: none;
            position: relative;
            background-color: #fff;
            width: 100%;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .sidebar ul li ul li {
            padding: 10px 20px;
            white-space: nowrap;
        }

        .sidebar ul li ul li a {
            color: #000;
            text-decoration: none;
            display: block;
        }

        .sidebar ul li:hover > ul {
            display: block;
        }

        /* Top bar styles */
        .top-bar {
            height: 50px;
            background-color: #8ECAE6;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            padding: 0 20px;
            border-bottom: 1px solid #ccc;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1001;
        }

        .top-bar ion-icon {
            font-size: 40px;
            cursor: pointer;
            margin-top: 10px;
        }

        .top-bar .logo-container {
            display: flex;
            align-items: center;
            height: 100%;
        }

        .top-bar .logo {
            height: 30px;
            margin-left: 10px;
            width: auto;
        }

        /* Dropdown styles */
        .dropdown {
            position: relative;
            display: inline-block;
            margin-left: auto;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            width: 170px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            top: 100%;
            border-radius: 20px;
        }



        .dropdown-content a {
            color: #333 !important;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            border-radius: 20px;
        }

        .dropdown-content a:hover {
            background-color: #FEC619;
            color: #000;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* FORM */


        .main-container {
        display: flex;
        flex-direction: column;
        align-items: center; /* Center items horizontally */
        justify-content: center; /* Center items vertically */
        max-width: 800px; /* Adjust the width as needed */
        margin: 70px auto; /* Adjust the margin as needed */
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .upload-box {
        position: relative;
        width: 510px; /* Adjust the width as needed */
        height: 250px; /* Adjust the height as needed */
        border: 2px dashed #ccc;
        border-radius: 5px;
        padding: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border-style: dashed;
        border-radius: 10px;
        /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        margin: 1em 4em 2em 4em; /* Add this line to center the box horizontally */
        text-align: center; /* Add this line to center the label and input horizontally */
        }

        .upload-label {
        font-size: 20px;
        color: #333;
        text-align: center;
        padding: 10px;
        }

        .upload-box input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        }

        .upload-box:hover {
        border-color: #FEC619;
        background-color: #f5f5f5;
        }

        form button {
        margin-top: 10px;
        padding: 15px 50px;
        background-color: #FEC619;
        color: #fff;
        border: none;
        font-size: 20px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: block; /* Center the button horizontally */
        margin: auto; /* Center the button horizontally */
        }

        form button:hover {
        background-color: #ef9b1c;
        }



        /* message css */
        .alert {
                border-radius: 5px;
                max-width: 800px;
            }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            margin-top: 10px;
            /* white-space: pre-wrap; Preserve whitespace for new lines */
            width: 96%;
            text-align: left; /* Add this line to align the text to the left */
            vertical-align: middle;
        }

        .alert-danger {
            padding: 10px;
            margin-top: 10px;
            background-color: #f8d7da;
            color: #721c24;
            vertical-align: middle;
            
        }

        .alert-warning {
            padding: 10px;
            margin-top: 10px;
            background-color: #fff3cd;
            color: #856404;
            vertical-align: middle;
            
        }


        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .top-bar .logo {
                height: 30px;
            }

            .sidebar ul .dropdown {
                position: relative;
            }

            .sidebar ul .dropdown-content {
                display: none;
                position: absolute;
                left: 100%;
                top: 0;
                background-color: #fff;
                min-width: 200px;
                box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .sidebar ul .dropdown:hover .dropdown-content {
                display: block;
            }

            .sidebar ul .dropdown-content a {
                color: #333;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .sidebar ul .dropdown-content a:hover {
                background-color: #FEC619;
                color: #fff;
            }
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li class="mainmenu"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li >
                <a href="{{ route('admin.masterlistDashboard') }}" class="mainmenu">MasterLists</a>
                <ul class="submenu">
                    <li><a href="{{ route('students.index') }}">Students</a></li>
                    <li><a href="{{ route('instructors.index') }}">Instructors</a></li>
                    <li><a href="{{ route('course_management.index') }}">Courses</a></li>
                </ul>
            </li>
            <li >
                <a href="{{ route('enrollment.dashboard') }}" class="mainmenu">Enroll Students</a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.enrollmentManual') }}">Manual Entry</a></li>
                    <li><a href="{{ route('admin.enrollmentCSV') }}">CSV Import</a></li>
                    
                </ul>
            </li>
            <li >
                <a href="{{ route('admin.userDashboard') }}" class="mainmenu">Add Users</a>
                <ul class="submenu">
                    <li><a href="{{ route('admin.manualEntryDashboard') }}">Manual Entry</a></li>
                    <li><a href="{{ route('admin.UsersCSV') }}">CSV Import</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="content-container">
        <div class="top-bar">
            <ion-icon name="menu-outline" id="burger-menu" style="color: #000;"></ion-icon>
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="EnLite" class="logo">
            </div>
            <div class="dropdown">  
                <ion-icon name="person-circle" id="user-menu" style="color: #000000; margin-left: 2rem;"></ion-icon>
                <div class="dropdown-content">
                    <a href="{{ route('profile.changePasswordForm') }}">Change Password</a>
                    <a href="/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-container">
        <h1>Import Students CSV</h1>
        <form action="{{ route('import.studentEnrollment') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="upload-box">
                <input type="file" name="file" accept=".csv" id="file-input">
                <label for="file-input" class="upload-label" id="upload-label">Click to Upload</label>
            </div>
            <button type="submit">Import CSV</button>
        </form>
        @if (session('success'))
            <div class="alert alert-success">
                
                <div>
                    <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
                    {{ session('success') }}
                    <br >
                </div>
            </div>
        @endif

        @if (session('warnings'))
            <div class="alert alert-warning">
                @foreach (session('warnings') as $warning)
                    <div>
                        <ion-icon name="warning" style="color: #orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                        {{ $warning }}
                        <br >
                    </div>
                @endforeach
            </div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">
                @php
                    $error = session()->get('error');
                    if (!is_array($error)) {
                        $error = [$error]; // wrap string in an array
                    }
                @endphp
                @foreach($error as $err)
                    <div>
                        <ion-icon name="close-circle" style="color: #red; font-size: 20px; vertical-align: middle;"></ion-icon>
                        {{ $err }}
                        <br >
                    </div>
                @endforeach
            </div>
        @endif

        
    </div>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        document.getElementById('burger-menu').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });

        document.getElementById('user-menu').addEventListener('click', function () {
            document.querySelector('.dropdown-content').classList.toggle('show');
        });

        window.onclick = function (event) {
            if (!event.target.matches('#user-menu')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }

        //change the Upload a file text to (imported file name)
        document.getElementById('file-input').addEventListener('change', function() {
            var fileName = this.value.split('\\').pop();
            document.getElementById('upload-label').innerHTML = fileName;
        });
    </script>
</body>

</html>