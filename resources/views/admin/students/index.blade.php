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
            background-color: #FEC619; 
            border-radius: 10px;
            padding: 15px 20px;
        }

        .submenu li:hover {
            background-color: #FEC619; 
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

                .alert {
            transition: opacity 0.5s;
        }

        .alert.fade-out {
            opacity: 0;
        }

        .search-input-container {
            margin-bottom: 10px;
        }

        .masterlist-header {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100px; /* adjust the height as needed */
        margin-top: 50px;
        }


        .search-input {
            border-radius: 60px;
            padding: 10px 20px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .search-button {
        margin-top: 10px;
        margin-left: 5px;
        padding: 10px 20px;
        color: #ffffff;
        border: none;
        font-size: 15px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        background-color: #f6bb30;
        }
        
        .search-button:hover{
            color: #000000;
            text-decoration: none;
            background-color: #f4a81b;
        }

        .search-button, .reset-button, .add-student {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }


        .search-button:hover, .reset-button:hover, .add-student:hover {
        background-color: #f4a81b;
        color: #000;
        }

        .reset-button {
            margin-top: 10px;
            margin-left: 5px;
        padding: 10px 20px;
        color: #000000;
        border: none;
        font-size: 15px;
        border-radius: 10px;
        cursor: pointer;
        transition: background-color 0.3s ease;
            background-color: #d4d4d4
        }

        .reset-button:hover{
            color: #ffffff;
            text-decoration: none;
            background-color: #6f6f6f
        }

        .table-header {
        background-color: #004da9;
        color: white;
        text-align: center;
        border-radius: 50px;
        }
        .table {
        width: 100%;
        overflow-x: auto;
        border-collapse: collapse;
        }

        .table th, .table td {
        padding: 10px;
        border: 1px solid #ddd;
        }

        

        .table-data{
            background-color: #f9f9f9;
        color: black;
        }


        .table-data td:last-child {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 5px; /* add a 10px gap between elements */
        }
        .add-student{
        padding: 15px 20px;
        background-color: #FEC619;
        color: #fff;
        border: none;
        font-size: 18px;
        border-radius: 50px;
        cursor: pointer;
        width: 20%;
        transition: background-color 0.3s ease;
        display: block; /* Center the button horizontally */
        margin: auto; /* Center the button horizontally */
        text-align: center;
        margin-top: 30px;
        margin-bottom: 30px;
        }
        .add-student:hover {
        background-color: #f8b825;
        color: #323131;
        text-decoration: none;
        }

        @media (max-width: 1000px) {
            .sidebar {
                width: 150px;
            }

            .top-bar {
                height: 40px;
            }

            .top-bar .logo {
                height: 25px;
            }

            .main-content {
                margin-top: 3rem;
                padding: 15px;
            }

            .dashboard {
                flex-wrap: wrap;
                gap: 15px;
            }

            .dashboard-p {
                font-size: 24px;
                margin-left: 0;
                text-align: center;
            }

            .card {
                width: 250px;
                height: 250px;
                margin: 10px;
            }

            .card ion-icon {
                font-size: 100px;
            }

            .card p {
                font-size: 12px;
            }

            .message-container {
                flex-direction: column;
                align-items: center;
            }

            .alert.alert-success {
                width: 90%;
                margin: 10px auto;
            }

            .table {
                font-size: 14px;
            }

            .table th, .table td {
                padding: 5px;
            }

            .search-input-container {
                flex-direction: column;
                align-items: center;
            }

            .search-input {
                width: 100%;
                margin-bottom: 10px;
            }

            .search-button, .reset-button {
                width: 100%;
                margin-bottom: 10px;
            }

            .add-student {
                width: 100%;
                margin-bottom: 20px;
            }
            }

            @media (max-width: 990px) {

            .main-content {
                text-align: center;
            }
            .masterlist-header {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100px; 
                margin-top: 50px;
                padding: 0px;
            }


            .search-input-container {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }

    
            .search-button, .reset-button {
                margin: 10px auto;
                display: block;
                text-align: center;
            }

            .table {
                margin: 0px;
                display: inline-block;
            }


            .table th, .table td {
                text-align: center;
            }

            .add-student {
                margin: 20px auto;
                display: block;
            }

    
            .alert {
                margin: 20px auto;
                display: block;
                text-align: center;
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


    <div class="main-content">
        @extends('layout')

        @section('content')
            <div class="masterlist-header">
                <h1>MASTERLIST OF STUDENTS</h1>
            </div>
            
            
            
            @if(session('success'))
                <div class="alert alert-success">
                    <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('students.search') }}" method="GET" class="mb-4">
                <div class="search-input-container">
                    <input type="text" name="student_id" class="search-input" placeholder="Search by Student ID">
                </div>
                <button type="submit" class="search-button">Search Student</button>
                <a href="{{ route('students.index') }}" class="reset-button">Clear Search</a>
            </form>

            <table class="table table-bordered">
                    <tr class="table-header">
                        <th style="width: 60px;">ID</th>
                        <th>First Name</th>
                        <th style="width: 30px;">Middle Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Birthdate</th>
                        <th>Contact Number</th>
                        <th>Enrollment Status</th>
                        <th>Actions</th>
                    </tr>
                <tbody>
                    @foreach ($students as $student)
                        <tr class="table-data">
                            <td style="text-align:center;">
                                <a href="{{ route('admin.grades.grades', $student->StudentID) }}">
                                    {{ $student->StudentID }}
                                </a>
                            </td>
                            <td>{{ $student->FirstName }}</td>
                            <td>{{ $student->MiddleName }}</td>
                            <td>{{ $student->LastName }}</td>
                            <td>{{ $student->Email }}</td>
                            <td>{{ $student->Address }}</td>
                            <td>{{ $student->Birthdate }}</td>
                            <td>{{ $student->ContactNumber }}</td>
                            <td>{{ $student->EnrollmentStatus }}</td>
                            <td class="text-right">
                                <a href="{{ route('students.edit', $student->StudentID) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('students.destroy', $student->StudentID) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('admin.studentManualEntry') }}" class="add-student">Add New Student</a>
        @endsection
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

        setTimeout(function() {
        document.querySelector('.alert').classList.add('fade-out');
        setTimeout(function() {
            document.querySelector('.alert').remove();
        }, 500);
    }, 5000);
    </script>
</body>
</html>
