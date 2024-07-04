<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

        .main-content {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        margin-top: 5rem;
        padding: 20px;
        }

        .form-container {
            margin: 5rem auto;
            width: 800px;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }

        

        .form-container h2 {
            display: flex;
            justify-content: center;
            font-family:Arial, Helvetica, sans-serif;
            font-style: normal;
            font-weight: 500;
        }

        .form-container button {
            display: block;
            width: 100%;
            margin: 20px auto 0;
            background-color: #FEC619;
            color: #000;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-container button:hover {
            background-color: #FFA300;
        }

        @media (max-width: 1200px) {
            .form-container {
                width: 600px;
            }
        }

        @media (max-width: 992px) {
            .form-container {
                width: 500px;
            }
        }

        @media (max-width: 768px) {
            .form-container {
                width: 400px;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                width: 300px;
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

    <div class="form-container">
        
        <h2 class="my-4">Instructor's Information</h2>

        @if(session('success'))
        <div class="alert alert-success">
            <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            
        <form action="{{ route('instructors.update', $instructor->InstructorID) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>First Name</label>
                <input type="text" class="form-control" name="FirstName" value="{{ $instructor->FirstName }}" required>
            </div>

            <div class="form-group">
                <label for="MiddleName">Middle Name</label>
                <input type="text" class="form-control" id="MiddleName" name="MiddleName" value="{{ $instructor->MiddleName }}">
            </div>

            <div class="form-group">
                <label for="LastName">Last Name</label>
                <input type="text" class="form-control" id="LastName" name="LastName" value="{{ $instructor->LastName }}" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" name="Email" class="form-control" value="{{ $instructor->Email }}">
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" name="Address" class="form-control" value="{{ $instructor->Address }}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
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
    </script>
</body>

</html>
