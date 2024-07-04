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
    min-width: 120px;
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
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li class="mainmenu"><a href="dashboard">Dashboard</a></li>
            <li >
                <a href="#" class="mainmenu">MasterLists</a>
                <ul class="submenu">
                    <li><a href="">Students</a></li>
                    <li><a href="">Instructors</a></li>
                    <li><a href="">Courses</a></li>
                </ul>
            </li>
            <li >
                <a href="enrollmentDashboard" class="mainmenu">Enroll Students</a>
                <ul class="submenu">
                    <li><a href="enrollmentManual">Manual Entry</a></li>
                    <li><a href="">CSV Import</a></li>
                    
                </ul>
            </li>
            <li >
                <a href="#" class="mainmenu">Add Users</a>
                <ul class="submenu">
                    <li><a href="manualEntryDashboard">Manual Entry</a></li>
                    <li><a href="">CSV Import</a></li>
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
                    <a href="studentprofile">Profile</a>
                    <a href="/">Logout</a>
                </div>
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
