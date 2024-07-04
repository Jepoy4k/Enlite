<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">
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
            background-color: #fff;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 21px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
            margin-top: 5rem;
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
            width: 100%;
            text-align: left;
            padding: 15px 20px;
            box-sizing: border-box;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .sidebar ul li.active {
            background-color: #FEC619;
            border-radius: 20px;
            width: calc(auto - 2px);
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

        .sidebar ul li:hover {
            background-color: #FEC619;
            border-radius: 20px;
            width: calc(auto - 2px);
        }

        .sidebar ul li:hover a {
            color: #000;
        }

        .top-bar {
            height: 50px;
            background-color: #8ECAE6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 20px 10px 0px;
            border-bottom: 1px solid #ccc;
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
            height: 70px;
            max-height: 100%;
            margin-left: 10px;
            width: auto;
            margin-right: 100rem;
        }

        .dropdown {
            position: relative;
            display: inline-block;
            margin-right: 20px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
            top: 100%;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        .content-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
        }

        .profile{
            width: 100%;
            max-width: 1600px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 5rem;
        }

        .profile-content{
            display: flex;
            align-items: center;
            width: 20%;
        }

        .profile-content-account {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 900px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            
        }

        .profile-card {
            flex: 1;
            height: 19rem;
            text-align: center;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-right: 2rem;
            border-radius: 20px;
        }

        .student-name{
            font-size: 20px;
            font-weight: 600;
            padding-bottom: 20px;
        }

        .student-name1{
            font-size: 15px;
            font-weight: 600;
        }

        .profile-card img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .profile-card p {
            margin: 5px 0;
        }

        .profile-form {
            flex: 2;
            padding: 20px;
        }

        .profile-form h2 {
            margin-bottom: 20px;
        }

        .profile-form .form-group {
            margin-bottom: 15px;
        }

        .profile-form label {
            display: block;
            margin-bottom: 5px;
        }

        .profile-form input[type="text"],
        .profile-form input[type="email"],
        .profile-form input[type="tel"],
        .profile-form input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .profile-form .form-actions {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .profile-form .form-actions button {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .save-btn {
            background-color: #FEC619;
            color: #000;
        }

        .save-btn:hover {
            background-color: rgba(116, 175, 245, 0.5);
            color: #000;
        }

        .cancel-btn {
            background-color: #ccc;
            color: #000;
        }

        .cancel-btn:hover {
            background-color: #DC3232;
            color: #000;
        }

        .profile-form .nav-buttons {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .profile-form .nav-buttons button {
            margin-left: 10px;
            padding: 10px 20px;
            background-color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: #000;
        }

        .profile-form .nav-buttons button.selected {
            background-color: #FEC619;
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
            <li><a href="dashboardstudent">Dashboard</a></li>
            <li class="active"><a href="studentprofile">Profile</a></li>
            <li><a href="studentnotification">Notification</a></li>
            <li><a href="studentgrades">Grades</a></li>
            <li><a href="studentcoursemanagement">Course Management</a></li>
        </ul>
    </div>
    <div class="content-container">
        <div class="top-bar">
            <ion-icon name="menu-outline" id="burger-menu" style="color: #000;"></ion-icon>
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="EnLite" class="logo">
            </div>
            <div class="dropdown">
                <ion-icon name="person-circle" id="user-menu" style="color: #000; margin-left:5rem;"></ion-icon>
                <div class="dropdown-content">
                    <a href="studentprofile">Profile</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>

        <div class="profile">
            <div class="profile-content">
                <div class="profile-card">
                    <img src="{{ asset('noprofile.png') }}" alt="Profile Picture">
                    <p class="student-name">BALAGULAN, NECZAR O</p>
                    <p>2021012345</p>
                    <p class="student-name1">STUDENT</p>
                </div>
            </div>
            <div class="profile-content-account">
                <div class="profile-form">
                    <div class="nav-buttons">
                        <button id="user-account-info-btn" class="selected">User Account Info</button>
                        <button id="change-password-btn">Change Password</button>
                    </div>
                    <div id="user-account-info-section">
                        <h2>Profile Account</h2>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" value="2021012345">
                        </div>
                        <div class="form-group">
                            <label for="complete-name">Complete Name</label>
                            <input type="text" id="complete-name" value="BALAGULAN, NECZAR O">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="balagulan.neczar@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="mobile-number">Mobile Number</label>
                            <input type="tel" id="mobile-number" value="09123344566">
                        </div>
                        <div class="form-group">
                            <label for="academic-program">Academic Program</label>
                            <input type="text" id="academic-program" value="B.S in Information Technology">
                        </div>
                        <div class="form-group">
                            <label for="group">Group</label>
                            <input type="text" id="group" value="Students">
                        </div>
                        <div class="form-actions">
                            <button class="save-btn">Save Changes</button>
                            <button class="cancel-btn">Cancel</button>
                        </div>
                    </div>
                    <div id="change-password-section" style="display: none;">
                        <h2>Change Password</h2>
                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password">
                        </div>
                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Re-type New Password</label>
                            <input type="password" id="confirm-password">
                        </div>
                        <div class="form-actions">
                            <button class="save-btn">Change Password</button>
                            <button class="cancel-btn">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        document.getElementById('burger-menu').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('shifted');
        });

        document.getElementById('user-menu').addEventListener('click', function() {
            document.getElementById('user-dropdown').classList.toggle('show');
        });

        window.onclick = function(event) {
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

        document.getElementById('user-account-info-btn').addEventListener('click', function() {
            document.getElementById('user-account-info-section').style.display = 'block';
            document.getElementById('change-password-section').style.display = 'none';
            this.classList.add('selected');
            document.getElementById('change-password-btn').classList.remove('selected');
        });

        document.getElementById('change-password-btn').addEventListener('click', function() {
            document.getElementById('change-password-section').style.display = 'block';
            document.getElementById('user-account-info-section').style.display = 'none';
            this.classList.add('selected');
            document.getElementById('user-account-info-btn').classList.remove('selected');
        });
    </script>
</body>

</html>