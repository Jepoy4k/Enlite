<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.css">
    <title>Course Portal</title>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            min-width: 100vw;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
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
            margin-top: 4rem;
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
            width: 100%;
            position: fixed;
            top: 0;
            z-index: 999;
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
            min-height: calc(100vh - 50px);
            padding-top: 50px;
            overflow: auto;
        }

        .dashboard-container {
            display: flex;
            flex-direction: column;
            padding: 20px;
            margin-left: 2rem;
        }

        .header-buttons-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .dashboard-p {
            font-family: Arial, sans-serif;
            font-size: 35px;
            font-weight: bold;
            color: #000;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f2f2f2;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-left: 103rem;
        }

        .buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .add-student {
            background-color: #ffc619;
            color: #fff;
        }

        .drop {
            background-color: #dc3545;
            color: #fff;
            visibility: hidden; /* Hide the button without removing it from the layout */
            opacity: 0; /* Make the button invisible */
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            z-index: 1001;
            width: 300px;
            text-align: center;
        }

        .popup.active {
            display: block;
        }

        .popup-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .popup-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }

        .popup-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #ffc619;
            color: #fff;
        }

        .popup-buttons button:last-child {
            background-color: #28a745;
        }

        .popup-buttons span {
            margin: 0 10px;
        }

        .popup-form {
            display: none;
            flex-direction: column;
            gap: 10px;
        }

        .popup-form.active {
            display: flex;
        }

        .popup-form input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .popup-form button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #ffc619;
            color: #fff;
        }

        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
            font-size: 20px;
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

        .popup-background.active {
            display: block;
        }

        .notification {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ff6961;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1002;
        }

        .notification.active {
            display: block;
        }

        .search-container {
            display: flex;
            align-items: center;
            margin-left: auto;
            margin-right: 1px;
            background-color: #f2f2f2;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .search-container ion-icon {
            font-size: 20px;
            color: #888;
        }

        .search-container input {
            border: none;
            outline: none;
            background: none;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 20px;
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
                </div>
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
                <ion-icon name="person-circle" id="user-menu" style="color: #000; margin-left:5rem;"></ion-icon>
                <div class="dropdown-content">
                    <a href="teacherprofile">Profile</a>
                    <a href="login">Logout</a>
                </div>
            </div>
        </div>
        <div class="main-content" id="main-content">
            <div class="dashboard-container">
                <div class="header-buttons-container">
                    <h1 class="dashboard-p" id="course-name">Networking 1</h1>
                    <div class="search-container">
                        <ion-icon name="search-outline"></ion-icon>
                        <input type="text" placeholder="Search here..." id="search-input">
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>LastName</th>
                            <th>FirstName</th>
                            <th>MiddleName</th>
                        </tr>
                    </thead>
                    <tbody id="student-table-body">
                    </tbody>
                </table>
                <div class="buttons">
                    <button class="drop" id="drop-button">Drop</button>
                    <button class="add-student" id="add-student-button">Add Student</button>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-background" id="popup-background"></div>
    <div class="popup" id="popup">
        <div class="popup-header">Add Student</div>
        <ion-icon name="close-outline" class="popup-close" id="popup-close"></ion-icon>
        <div class="popup-buttons" id="popup-buttons">
            <button id="manual-input-button">Manual Input</button>
            <span>or</span>
            <button id="upload-csv-button">Upload CSV</button>
        </div>
        <div class="popup-form" id="manual-input-form">
            <ion-icon name="close-outline" class="popup-close" id="form-close"></ion-icon>
            <input type="text" id="student-id" placeholder="ID">
            <input type="text" id="student-lastname" placeholder="Last Name">
            <input type="text" id="student-firstname" placeholder="First Name">
            <input type="text" id="student-middlename" placeholder="Middle Name">
            <button id="submit-button">Submit</button>
        </div>
    </div>
    <div class="notification" id="notification">Student already enrolled</div>
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

        const checkboxes = document.querySelectorAll('.student-checkbox');
        const dropButton = document.getElementById('drop-button');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                dropButton.style.visibility = anyChecked ? 'visible' : 'hidden';
                dropButton.style.opacity = anyChecked ? '1' : '0';
            });
        });

        const addStudentButton = document.getElementById('add-student-button');
        const popup = document.getElementById('popup');
        const popupBackground = document.getElementById('popup-background');
        const popupClose = document.getElementById('popup-close');
        const formClose = document.getElementById('form-close');
        const manualInputButton = document.getElementById('manual-input-button');
        const uploadCsvButton = document.getElementById('upload-csv-button');
        const manualInputForm = document.getElementById('manual-input-form');
        const popupButtons = document.getElementById('popup-buttons');
        const notification = document.getElementById('notification');

        addStudentButton.addEventListener('click', function() {
            popup.classList.add('active');
            popupBackground.classList.add('active');
        });

        popupClose.addEventListener('click', function() {
            closePopup();
        });

        formClose.addEventListener('click', function() {
            manualInputForm.classList.remove('active');
            popupButtons.style.display = 'flex';
        });

        popupBackground.addEventListener('click', function() {
            closePopup();
        });

        manualInputButton.addEventListener('click', function() {
            manualInputForm.classList.add('active');
            popupButtons.style.display = 'none';
        });

        uploadCsvButton.addEventListener('click', function() {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = '.csv';
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    handleCsvUpload(file);
                }
            });
            fileInput.click();
        });

        document.getElementById('submit-button').addEventListener('click', function() {
            const id = document.getElementById('student-id').value;
            const lastName = document.getElementById('student-lastname').value;
            const firstName = document.getElementById('student-firstname').value;
            const middleName = document.getElementById('student-middlename').value;

            const exists = checkStudentExists(id);
            if (exists) {
                showNotification();
            } else {
        
                addStudentToTable(id, lastName, firstName, middleName);
            }

            document.getElementById('student-id').value = '';
            document.getElementById('student-lastname').value = '';
            document.getElementById('student-firstname').value = '';
            document.getElementById('student-middlename').value = '';

            closePopup();
        });

        dropButton.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.student-checkbox:checked');
            checkedBoxes.forEach(checkbox => {
                checkbox.closest('tr').remove();
            });
            dropButton.style.visibility = 'hidden';
            dropButton.style.opacity = '0';
        });

        document.getElementById('search-input').addEventListener('input', function() {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll('#student-table-body tr');
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                const match = Array.from(cells).some(cell => cell.textContent.toLowerCase().includes(filter));
                row.style.display = match ? '' : 'none';
            });
        });

        function handleCsvUpload(file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const lines = event.target.result.split('\n');
                let duplicates = false;
                lines.forEach(line => {
                    const [id, lastName, firstName, middleName] = line.split(',');
                    if (id && lastName && firstName && middleName) {
                        const exists = checkStudentExists(id);
                        if (exists) {
                            duplicates = true;
                        } else {
                            addStudentToTable(id, lastName, firstName, middleName);
                        }
                    }
                });
                if (duplicates) {
                    showNotification();
                }
                closePopup();
            };
            reader.readAsText(file);
        }

        function addStudentToTable(id, lastName, firstName, middleName) {
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td><input type="checkbox" class="student-checkbox"></td>
                <td>${id}</td>
                <td>${lastName}</td>
                <td>${firstName}</td>
                <td>${middleName}</td>
            `;
            document.getElementById('student-table-body').appendChild(newRow);

            newRow.querySelector('.student-checkbox').addEventListener('change', function() {
                const anyChecked = Array.from(document.querySelectorAll('.student-checkbox')).some(checkbox => checkbox.checked);
                dropButton.style.visibility = anyChecked ? 'visible' : 'hidden';
                dropButton.style.opacity = anyChecked ? '1' : '0';
            });
        }

        function checkStudentExists(id) {
            const rows = document.querySelectorAll('#student-table-body tr');
            for (let row of rows) {
                const cells = row.querySelectorAll('td');
                if (cells[1].textContent === id) {
                    return true;
                }
            }
            return false;
        }

        function closePopup() {
            popup.classList.remove('active');
            popupBackground.classList.remove('active');
            manualInputForm.classList.remove('active');
            popupButtons.style.display = 'flex';
        }

        function showNotification() {
            notification.classList.add('active');
            setTimeout(() => {
                notification.classList.remove('active');
            }, 3000);
        }

        // Load the selected course from local storage
        document.addEventListener('DOMContentLoaded', function() {
            const selectedCourses = JSON.parse(localStorage.getItem('selectedCourses'));
            if (selectedCourses && selectedCourses.length > 0) {
                document.getElementById('course-name').textContent = selectedCourses.join(', ');
            } else {
                document.getElementById('course-name').textContent = 'Networking 1';
            }
        });
    </script>
</body>

</html>
