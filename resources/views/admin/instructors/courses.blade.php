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
            text-decoration: none;
        }

        .dropdown-content a:hover {
            background-color: #FEC619;
            color: #000;
            text-decoration: none;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* //message timeout */
        .alert {
            transition: opacity 0.5s;
        }

        .alert.fade-out {
            opacity: 0;
        }

        .search-bar[type="text"] {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 20px;
        width: 83%;
        margin-bottom: 20px;
        }

        .search-button[type="submit"] {
        background-color: #FEC619;
        color: #fff;
        padding: 8px 15px;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        }

        .form-group button[type="submit"]:hover {
        background-color: #f4b728;
        }

        .container {
            margin: 80px auto; /* Add this line */
            
        }

        .container h1{
            background-color:#004da9;
            color: #fff;
            padding:20px;
        }

        .col-md-6 {
            margin: 20px auto;
            
        }

        .form-group{
            /* border: 1px solid #eb2323; */
            border-radius: 20px;
        }

        .form-group label{
            font-size: 20px; 
            font-weight:500;
            
        }

        .btn.btn-success{
            background-color:#FEC619;
            border: none;
        }

        .btn.btn-success:hover{
            background-color: #f4b728;
            color: #323131;
        }
        .select-added-courses-div{
            height: 400px;
            overflow-y: auto;
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

        
    
    @media (min-width: 769px) and (max-width: 992px) {
       .sidebar {
            width: 250px;
        }
       .top-bar {
            flex-direction: row;
        }
       .top-bar.logo-container {
            margin-bottom: 0;
        }

        
    }

    @media (max-width: 993px) {
       .sidebar {
            width: 300px;
        }

        .search-button[type="submit"]{
            margin-bottom: 20px;
        }
    }

    @media (max-width: 751px) {
        .select-added-courses-div{
            height: 200px;
            /* padding: 0px;
            margin: 0px;
            border: red 5px solid; */
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


    <div>
        @extends('admin.instructors.app')

        @section('content')
        <div class="container">
            <h1>{{ $instructor->FirstName ?? '' }} {{ $instructor->MiddleName ?? '' }} {{ $instructor->LastName }}'s Courses</h1>

            @if(session('success'))
            <div class="alert alert-success">
                <ion-icon name="checkmark-circle" style="color: #green; font-size: 20px; vertical-align: middle;"></ion-icon>
                {{ session('success') }}
            </div>
            @endif
        
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="courses">Courses</label>
                        <form action="{{ route('instructors.courses.search', $instructor->InstructorID) }}" method="post">
                            @csrf
                            <input type="text" class="search-bar" name="searchTerm" placeholder="Search for a course...">
                            <button type="submit" class="search-button">Search</button>
                        </form>
                        <ul class="list-group" id="courseList">
                            @foreach($courses as $course)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $course->CourseID }} - {{ $course->Description }}</span>
                                <div>
                                    @if(in_array($course->CourseID, $addedCourseIDs))
                                    <form action="{{ route('instructors.courses.drop', [$instructor->InstructorID, $course->CourseID]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger">Drop</button>
                                    </form>
                                    @else
                                    <form action="{{ route('instructors.courses.add', [$instructor->InstructorID, $course->CourseID]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </form>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="added_courses">Added Courses</label>
                        <div class="select-added-courses">
                            <div class='select-added-courses-div'>
                                <select id="added_courses" name="added_courses[]" class="form-control" multiple size="8">
                                    @foreach($addedCourses as $addedCourse)
                                    <option value="{{ $addedCourse->CourseID }}">{{ $addedCourse->CourseID }} - {{ $addedCourse->Description }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('instructors.index')}}" class="btn btn-secondary">Back</a>
        </div>
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

        function searchCourses() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("courseSearch");
            filter = input.value.toUpperCase();
            ul = document.getElementById("courseList");
            li = ul.getElementsByTagName("li");

            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>