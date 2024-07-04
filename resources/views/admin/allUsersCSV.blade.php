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
            /* .main-container-holder {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                overflow-y: auto;
            } */

            .main-container-holder {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            }

            .main-container {
                flex: 1;
                max-width: 45%; /* Adjust the width as needed */
                margin: 100px 20px; /* Adjust the margin as needed */
                display: flex; /* Add this line */
                flex-direction: column; /* Add this line */
                justify-content: center; /* Add this line */
                align-items: center; /* Add this line */
            }

            .main-container h1 {
            display: flex;
            justify-content: center;
            align-items: center;
            }

            .upload-box {
            position: relative;
            width: 310px; /* Adjust the width as needed */
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

        @media (max-width: 1200px) {
        .main-container {
            max-width: 60%; /* Increase the width on smaller screens */
        }
        }

        @media (max-width: 992px) {
        .main-container {
            max-width: 80%; /* Increase the width on smaller screens */
        }
        }

        @media (max-width: 768px) {
        .main-container {
            max-width: 100%; /* Take up full width on small screens */
            margin: 20px; /* Adjust the margin on small screens */
        }

        .main-container-holder {
            margin-top: 70px; /* adjust the value as needed */
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
                    2:22 am 04/07/2024
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

    <div class="main-container-holder">
        <div class="main-container">
            <h1>Import Users</h1>
            <form action="{{ route('admin.usersCSV') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="upload-box">
                    <input type="file" name="csv_file" accept=".csv" id="file-input-users">
                    <label for="file-input-users" class="upload-label" id="upload-label-users">Click to Upload</label>
                </div>
                <button type="submit">Import CSV</button>
            </form>
            @if (session('user_success'))
                <div class="alert alert-success">
                    <div>
                        <ion-icon name="checkmark-circle" style="color: green; font-size: 20px; vertical-align: middle;"></ion-icon>
                        {{ session('user_success') }}
                        <br>
                    </div>
                </div>
            @endif

            @if (session('user_warnings'))
                @if(is_array(session('user_warnings')))
                    <div class="alert alert-warning">
                        @foreach (session('user_warnings') as $warning)
                            <div>
                                <ion-icon name="warning" style="color: orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                                {{ $warning }}
                                <br>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        <div>
                            <ion-icon name="warning" style="color: orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                            {{ session('user_warnings') }}
                            <br>
                        </div>
                    </div>
                @endif
            @endif

            @if(session()->has('user_error'))
                @if(is_array(session('user_error')))
                    <div class="alert alert-danger">
                        @foreach(session('user_error') as $err)
                            <div>
                                <ion-icon name="close-circle" style="color:red; font-size: 20px; vertical-align: middle;"></ion-icon>
                                {{ $err }}
                                <br>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger">
                        <div>
                            <ion-icon name="close-circle" style="color: red; font-size: 20px; vertical-align: middle;"></ion-icon>
                            {{ session('user_error') }}
                            <br>
                        </div>
                    </div>
                @endif
            @endif
            
        </div>
        <div class="main-container">
            <h1>Import Students</h1>
            <form action="{{ route('admin.studentCSV') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="upload-box">
                    <input type="file" name="csv_file" accept=".csv" id="file-input-student">
                    <label for="file-input-student" class="upload-label" id="upload-label-student">Click to Upload</label>
                </div>
                <button type="submit">Import CSV</button>
            </form>
            @if (session('student_success'))
                <div class="alert alert-success">
                    <div>
                        <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
                        {{ session('student_success') }}
                        <br >
                    </div>
                </div>
            @endif

            @if (session('student_warnings'))
                @if(is_array(session('student_warnings')))
                    <div class="alert alert-warning">
                        @foreach (session('student_warnings') as $warning)
                            <div>
                                <ion-icon name="warning" style="color: #orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                                {{ $warning }}
                                <br >
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        <div>
                            <ion-icon name="warning" style="color: #orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                            {{ session('student_warnings') }}
                            <br >
                        </div>
                    </div>
                @endif
            @endif

            @if(session()->has('student_error'))
                @if(is_array(session('student_error')))
                    <div class="alert alert-danger">
                        @foreach(session('student_error') as $err)
                            <div>
                                <ion-icon name="close-circle" style="color:red; font-size: 20px; vertical-align: middle;"></ion-icon>
                                {{ $err }}
                                <br >
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger">
                        <div>
                            <ion-icon name="close-circle" style="color:red; font-size: 20px; vertical-align: middle;"></ion-icon>
                            {{ session('student_error') }}
                            <br >
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="main-container">
            <h1>Import Instructor</h1>
            <form id="instructor-csv-form" action="{{ route('admin.instructorCSV') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="upload-box">
                    <input type="file" name="csv_file" accept=".csv" id="file-input-instructor">
                    <label for="file-input-instructor" class="upload-label" id="upload-label-instructor">Click to Upload</label>
                </div>
                <button type="submit">Import CSV</button>
            </form>
            @if (session('instructor_success'))
                <div class="alert alert-success">
                    <div>
                        <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
                        {{ session('instructor_success') }}
                        <br >
                    </div>
                </div>
            @endif

            @if (session('instructor_warnings'))
                @if(is_array(session('instructor_warnings')))
                    <div class="alert alert-warning">
                        @foreach (session('instructor_warnings') as $warning)
                            <div>
                                <ion-icon name="warning" style="color: #orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                                {{ $warning }}
                                <br >
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning">
                        <div>
                            <ion-icon name="warning" style="color: #orange; font-size: 20px; vertical-align: middle;"></ion-icon> 
                            {{ session('instructor_warnings') }}
                            <br >
                        </div>
                    </div>
                @endif
            @endif

            @if(session()->has('instructor_error'))
                @if(is_array(session('instructor_error')))
                    <div class="alert alert-danger">
                        @foreach(session('instructor_error') as $err)
                            <div>
                                <ion-icon name="close-circle" style="color: red; font-size: 20px; vertical-align: middle;"></ion-icon>
                                {{ $err }}
                                <br >
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger">
                        <div>
                            <ion-icon name="close-circle" style="color: red; font-size: 20px; vertical-align: middle;"></ion-icon>
                            {{ session('instructor_error') }}
                            <br >
                        </div>
                    </div>
                @endif 
            @endif
        </div>
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

        document.getElementById('file-input-users').addEventListener('change', function() {
            var fileName = this.value.split('\\').pop();
            document.getElementById('upload-label-users').innerHTML = fileName;
        });
        document.getElementById('file-input-student').addEventListener('change', function() {
            var fileName = this.value.split('\\').pop();
            document.getElementById('upload-label-student').innerHTML = fileName;
        });
        document.getElementById('file-input-instructor').addEventListener('change', function() {
            var fileName = this.value.split('\\').pop();
            document.getElementById('upload-label-instructor').innerHTML = fileName;
        });
    </script>
</body>

</html>