<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">
    <title>Teacher Course Management</title>
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


        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        .main-content.shifted {
            margin-left: 200px;
        }

        .course-management-container {
            padding: 10px;
            margin-top: 5rem;
            margin-left: 4rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 110rem;
        }

        .course-management-container h1 {
            color: #333;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        .buttons {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        button {
            padding: 10px 20px;
            border: none;
            color: #fff;
            background-color: #007BFF;
            border-radius: 5px;
            cursor: pointer;
        }

        button.drop {
            background-color: #dc3545;
        }

        button.hidden {
            display: none;
        }

        button:hover {
            opacity: 0.9;
        }

        .add-course {
            background-color: #FEC619;
            color: #fff;
        }

        .add-course:hover {
            background-color: #FFA300;
        }

        .add-students {
            background-color: #28a745;
            color: #fff;
        }

        .add-students:hover {
            background-color: #218838;
        }

        .course-management-p {
            position: flex;
            width: 221px;
            height: 55px;
            left: 63px;
            top: 102px;
            font-family: 'Unna';
            font-style: normal;
            font-weight: 700;
            font-size: 30px;
            line-height: 35px;
            color: #000000;
            margin-left: 2rem;
        }

        .card {
            box-sizing: border-box;
            width: 170px;
            height: 180px;
            background: rgba(116, 175, 245, 0.29);
            border: 0.1px solid #B3B1B1;
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
            border-radius: 5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease;
        }

        .card ion-icon {
            font-size: 50px;
            margin-bottom: 10px;
        }

        .card p {
            margin: 0;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
        }

        .card.profile {
            background-color: rgba(116, 175, 245, 0.29);
        }

        .card.notification {
            background-color: rgba(116, 175, 245, 0.29);
        }

        .card.course-management {
            position: relative;
            background-color: rgba(116, 175, 245, 0.29);
        }

        .card:hover {
            background-color: rgba(116, 175, 245, 0.5);
        }

        .popup-background {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1001;
            width: 300px;
        }

        .popup.active {
            display: block;
        }

        .popup-header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .popup-header ion-icon {
            cursor: pointer;
        }

        .popup-form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .popup-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .popup-form button {
            padding: 10px 20px;
            border: none;
            background-color: #FEC619;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .popup-form button:hover {
            background-color: #FFA300;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.shifted {
                margin-left: 200px;

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
                color: #000;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                background-color: #fff;
                transition: background-color 0.3s ease, color 0.3s ease;

            }

            .sidebar ul .dropdown-content a:hover {
                background-color: #001B50;
                color: #fff;

            }

        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li><a href="dashboardteacher">Dashboard</a></li>
            <li><a href="teacherprofile">Profile</a></li>
            <li><a href="teachernotification">Notification</a></li>
            <li><a href="teachercoursemanagement">Course Management</a></li>
        </ul>
    </div>
    <div class="content-container">
        <div class="top-bar">
            <ion-icon name="menu" id="burger-menu" style="color: #000;"></ion-icon>
            <div class="logo-container">
                <img src="{{ asset('logo.png') }}" alt="EnLite" class="logo">
            </div>
            <div class="dropdown">
                <ion-icon name="person-circle" id="user-menu" style="color: #000; margin-left:5rem;"></ion-icon>
                <div class="dropdown-content">
                    <a href="teacherprofile">Profile</a>
                    <a href="#">Logout</a>
                </div>
            </div>
        </div>

        <div id="main-content">
            <div class="course-management-container">
                <h1>Course Management</h1>
                <table id="course-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Course Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="Networking 1"></td>
                            <td>Networking 1</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="Application Development and Emerging Technology"></td>
                            <td>Application Development and Emerging Technology</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="Integrative Programming and Technologies"></td>
                            <td>Integrative Programming and Technologies</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="Quantitative Methods"></td>
                            <td>Quantitative Methods</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="Foreign Language"></td>
                            <td>Foreign Language</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" class="course-checkbox" data-course-name="IT Elective 2"></td>
                            <td>IT Elective 2</td>
                        </tr>
                    </tbody>
                </table>
                <div class="buttons">
                    <button class="drop hidden">Drop</button>
                    <button class="add-students hidden" onclick="location.href='courseportalteacher'">Add Students</button>
                    <button class="add-course">Add Course</button>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-background" id="popup-background"></div>
    <div class="popup" id="popup">
        <div class="popup-header">
            Add Course
            <ion-icon name="close-outline" id="popup-close"></ion-icon>
        </div>
        <div class="popup-form">
            <input type="text" id="new-course-name" placeholder="Course Name">
            <button id="submit-course">Submit</button>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        document.getElementById('burger-menu').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('shifted');
        });

        document.getElementById('user-menu').addEventListener('click', function () {
            document.getElementById('user-dropdown').classList.toggle('show');
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

        const checkboxes = document.querySelectorAll('.course-checkbox');
        const dropButton = document.querySelector('.drop');
        const addStudentsButton = document.querySelector('.add-students');

        function updateButtonVisibility() {
            const anyChecked = Array.from(document.querySelectorAll('.course-checkbox')).some(checkbox => checkbox.checked);
            if (anyChecked) {
                dropButton.classList.remove('hidden');
                addStudentsButton.classList.remove('hidden');
            } else {
                dropButton.classList.add('hidden');
                addStudentsButton.classList.add('hidden');
            }
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                updateButtonVisibility();
                const checkedCourses = Array.from(document.querySelectorAll('.course-checkbox'))
                    .filter(checkbox => checkbox.checked)
                    .map(checkbox => checkbox.getAttribute('data-course-name'));
                localStorage.setItem('selectedCourses', JSON.stringify(checkedCourses));
            });
        });

        const addCourseButton = document.querySelector('.add-course');
        const popup = document.getElementById('popup');
        const popupBackground = document.getElementById('popup-background');
        const popupClose = document.getElementById('popup-close');
        const submitCourseButton = document.getElementById('submit-course');

        addCourseButton.addEventListener('click', () => {
            popup.classList.add('active');
            popupBackground.classList.add('active');
        });

        popupClose.addEventListener('click', () => {
            popup.classList.remove('active');
            popupBackground.classList.remove('active');
        });

        submitCourseButton.addEventListener('click', () => {
            const newCourseName = document.getElementById('new-course-name').value.trim();
            if (newCourseName) {
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><input type="checkbox" class="course-checkbox" data-course-name="${newCourseName}"></td>
                    <td>${newCourseName}</td>
                `;
                document.querySelector('#course-table tbody').appendChild(newRow);

                const newCheckbox = newRow.querySelector('.course-checkbox');
                newCheckbox.addEventListener('change', () => {
                    updateButtonVisibility();
                    const checkedCourses = Array.from(document.querySelectorAll('.course-checkbox'))
                        .filter(checkbox => checkbox.checked)
                        .map(checkbox => checkbox.getAttribute('data-course-name'));
                    localStorage.setItem('selectedCourses', JSON.stringify(checkedCourses));
                });

                // Clear the input field
                document.getElementById('new-course-name').value = '';

                // Close the popup
                popup.classList.remove('active');
                popupBackground.classList.remove('active');
            }
        });

        popupBackground.addEventListener('click', () => {
            popup.classList.remove('active');
            popupBackground.classList.remove('active');
        });

        // Initial button visibility update
        updateButtonVisibility();
    </script>
</body>

</html>
