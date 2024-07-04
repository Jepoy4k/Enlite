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

        .main-content {
            display: center;
            align-items: center;
            justify-content: center;
            margin-top: 4rem;
            /* margin-left: 60px; */
            padding: 20px;
            /* border: 5px solid #043630; */
            width: 100%;
        }

        .dashboard {
            display: flex;
            justify-content: center;
            /* flex-wrap: wrap; */
            gap: 25px;
            /* border: 2px solid #38cd1e; */
            width: 100%
            
        }

        .dashboard-p {
            width: 421px;
            height: 55px;
            font-family:Arial, Helvetica, sans-serif;
            font-style: normal;
            font-weight: 700;
            font-size: 38px;
            line-height: 35px;
            color: #000000;
            margin-left: 10rem;
            justify-content: center;
            text-align: center; 
            text-align: center;
            
        }

        .card {
            box-sizing: border-box;
            width: 350px;
            height: 350px;
            background: rgba(116, 175, 245, 0.29);
            border: 0.1px solid #B3B1B1;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            align-content: center;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            /* border: 2px solid #cd1e1e; */
        }

        .card ion-icon {
            font-size:  160px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .card.profile {
            background-color: #024089;
        }

        .card.notification {
            background-color: #FFA300;
        }

        .card.grades {
            background-color: #024089;
        }

        .card.course-management {
            background-color: #FFC619;
        }

        .card:hover {
            background-color: rgba(116, 175, 245, 0.5);
            color: #000;
        }

        .grid-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .grid-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 350px;
            height: 350px;
            background: rgba(116, 175, 245, 0.29);
            border: 0.1px solid #B3B1B1;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 30px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
        }

        .grid-item ion-icon {
            font-size: 160px;
            margin-bottom: 10px;
        }

        .grid-item p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .grid-item:hover {
            background-color: rgba(116, 175, 245, 0.5);
            color: #000;
        }

        @media (max-width: 1000px) {
        .sidebar {
            width: 150px;
        }

        .sidebar ul li {
            padding: 10px 15px;
        }

        .sidebar ul li a {
            font-size: 14px;
        }

        .top-bar {
            height: 40px;
        }

        .top-bar .logo {
            height: 25px;
        }

        .main-content {
            margin-top: 3rem;
        }

        .dashboard-p {
            font-size: 24px;
            margin-left: 0;
            text-align: center;
            margin: 15px;
        }

        .grid-container {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .grid-item {
            width: 250px;
            height: 250px;
        }

        .grid-item ion-icon {
            font-size: 120px;
        }

        .grid-item p {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 100px;
        }

        .sidebar ul li {
            padding: 5px 10px;
        }

        .sidebar ul li a {
            font-size: 12px;
        }

        .top-bar {
            height: 45px;
        }

        

        .main-content {
            margin-top: 2rem;
        }

        .dashboard-p {
            font-size: 18px;
            margin-left: 0;
            text-align: center;
            margin: 10px;
        }

        .grid-container {
            grid-template-columns: repeat(1, 1fr);
            gap: 10px;
        }

        .grid-item {
            width: 200px;
            height: 200px;
        }

        .grid-item ion-icon {
            font-size: 100px;
        }

        .grid-item p {
            font-size: 10px;
        }
    }

    @media (max-width: 480px) {
        .sidebar {
            width: 80px;
        }

        .sidebar ul li {
            padding: 3px 5px;
        }

        .sidebar ul li a {
            font-size: 10px;
        }

        

        .main-content {
            margin-top: 1.5rem;
        }

        .dashboard-p {
            font-size: 14px;
            margin-left: 0;
            text-align: center;
            margin: 5px;
        }

        .grid-container {
            grid-template-columns: repeat(1, 1fr);
            gap: 5px;
        }

        .grid-item {
            width: 150px;
            height: 150px;
        }

        .grid-item ion-icon {
            font-size: 80px;
        }

        .grid-item p {
            font-size: 8px;
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
    <div class="main-content" id="main-content">
        <p class="dashboard-p"> Masterlist Dashboard</p>
        <div class="dashboard" style="color: #fff;">
            <div class="grid-container">
                <a href="{{ route('students.index') }}" class="card profile grid-item">
                    <ion-icon name="school"></ion-icon>
                    <p>STUDENT</p>
                </a>
                <a href="{{ route('instructors.index') }}" class="card notification grid-item">
                    <ion-icon name="briefcase-outline"></ion-icon>
                    <p>INSTRUCTOR</p>
                </a>
                <a href="{{route ('course_management.index') }}" class="card profile grid-item">
                    <ion-icon name="library"></ion-icon>
                    <p>COURSES</p>
                </a>
                <a href="{{route ('classlist.index') }}" class="card profile grid-item" style="grid-column: 1 / 2;">
                    <ion-icon name="logo-firebase"></ion-icon>
                    <p>CLASSLISTS</p>
                </a>
            </div>
        </div>
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
    </script>
</body>

</html>
