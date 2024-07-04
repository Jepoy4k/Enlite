<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        h1.mb-4 {
            text-align: center;
            margin-top: 40px; 
        }
        button[type="submit"] {
        background-color: #FEC619; /* Yellow color */
            width: 200px; /* Adjust the width */
            height: 50px;
            display: block;
            margin: 0 auto; /* Center the button */
            border: none;
            border-radius: 50px;
        }

        button[type="submit"]:hover {
            background-color: #8ECAE6; /* Change the background color to a darker shade */
            color: #000000; /* Change the text color to white */
        }

        /*alert message */
            .alert.alert-success {
            display: flex;
            justify-content: flex-start; /* changed from center to flex-start */
            align-items: center;
        }

        .alert.alert-success ion-icon {
            margin-right: 10px; /*add some space between the icon and the text*/
        }

        .alert.alert-danger {
            display: flex;
            /* align-items: center; */
            justify-content: flex-start;
            flex-direction: column;
        }

        .alert.alert-danger ion-icon {
            margin-right: 10px;
            font-size: 20px;
            color: #red;
            vertical-align: middle;
        }

        .alert.alert-danger span {
            vertical-align: middle;
        }
        .form-container {
            margin-top:50px;
            background-color: #eeebebac;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        @media (max-width: 1200px){
            .form-container {
                margin-top: 30px;
            }
            .sidebar{
                margin-top:50px;
                padding-top: 20px;
            }
        }
        @media (max-width: 768px) {


        .main-content {
            margin-top: 0;
        }

        .form-container {
            width: 100%;
            padding: 10px;
        }

        
        .form-row {
            flex-direction: column; /* Add this to make the form rows stack on smaller screens */
        }
        .form-group {
            margin-bottom: 10px; /* Reduce the margin on smaller screens */
        }
        }

        @media (max-width: 890px) {
            
            .form-container {
                width: 100%;
                padding: 1rem;
            }
            .form-group {
                margin-bottom: 1rem;
            }
            .form-control {
                width: 100%;
                padding: 0.5rem;
                font-size: 1rem;
            }
            .btn {
                width: 100%;
                padding: 0.5rem;
                font-size: 1rem;
            }
            .form-container {
            margin-top: 30px;
            margin-bottom: 20px;
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
    <div class="container mt-5">
        
        <div class="form-container">
            <h1 class="mb-4">Manual Instructor Entry</h1>
            @if ($errors->any())
            <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <div>
                            <ion-icon name="close-circle" style="color: #red; font-size: 20px; margin-top:0px;"></ion-icon> 
                            {{ $error }}
                            <br >
                        </div>
                    @endforeach
            </div>
            @endif
    
            @if (session('success'))
                <div class="alert alert-success" style="margin-bottom: 30px;">
                    <ion-icon name="checkmark-circle" style="color: #168c33; font-size: 30px; margin-top:0px;"></ion-icon>
                    {{ session('success') }}
                </div>
            @endif
        <form action="{{ route('admin.instructorManualEntry') }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="UserID">User ID</label>
                    <select class="form-control" id="UserID" name="UserID" required>
                        <option value="">Select User</option>
                        @foreach($users as $user)
                            <option value="{{ $user->UserID }}">{{ $user->UserID }} - {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="NextInstructorID">Next Instructor ID</label>
                    <input type="text" class="form-control" id="NextInstructorID" name="NextInstructorID" value="{{ $nextInstructorID }}" readonly>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="MiddleName">Middle Name</label>
                    <input type="text" class="form-control" id="MiddleName" name="MiddleName">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="LastName">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email" name="Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Address">Address</label>
                <input type="text" class="form-control" id="Address" name="Address">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
