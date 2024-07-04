<!DOCTYPE html>
<html>
<head>
    <title>Class List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
        display: flex;
        justify-content: center;
        /* align-items: center; */
        height: 100vh;
        margin: 0;
        font-family:sans-serif
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
            margin-top: 8rem; /* Margin for top bar */
            font-size: 15px;
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
            text-align: left;
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

        .container {
            margin-top: 80px;
        }

        .container h2{
            margin-bottom: 25px;
        }

        label {
            margin-bottom: 10px;
            font-weight: 500;
            color: #333;
            font-size: 18px;
            margin-right: 5px; 
        }

        select {
            height: 40px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
        }
        .instructor-label{
            margin-left: 100px;
        }

        input[type="submit"] {
            margin-left: 20px; /* add some space between button and selects */
        }

        form{
            margin-bottom: 50px;
        }

        .table.table-bordered th {
        /* border: 1px solid #eb2323; */
        background-color: #004da9;
        font-size: 15px;
        font-weight: 600;
        color: #fff;
        border: 1px solid #004da9;
        }
        .btn.btn-success{
            background-color: #FFC619;
            border:none;
            padding: 15px;
            border-radius: 30px;
            
        }

        .btn.btn-success:hover{
            background-color: #FDA300;
            
            
        }

        .table tr:nth-child(even) {
        background-color: #f0f0f0;
        }

        .table a {
        text-decoration: none;
        color: #337ab7;
        }

        .table a:hover {
        color: #123e76;
        }

        .btn-secondary {
        
        background-color: #989696; /* change the background color */
        color: #fff; /* change the text color */
        border: none; /* remove the border */
        padding: 8px 20px; /* add some padding */
        border-radius: 30px; /* add a rounded corner */
        cursor: pointer; /* change the cursor shape */
        }

        .btn-secondary:hover {
        background-color: #444; /* change the background color on hover */
        color: #fff; /* keep the text color the same */
        }

        .btn.btn-primary{
            background-color: #ffc803;
            border:none;
            padding: 10px;
            border-radius: 10px;
        }

        .btn-primary:hover {
        background-color: #ffb702; /* change the background color on hover */
        color: #fff; /* keep the text color the same */
        }


        .export-button-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px; /* add some space between the table and the buttons */
}

.export-button-container .btn-secondary {
    margin: 0; /* remove the margin right */
    height: 35px; /* adjust the height of the back button */
    align-self: flex-start; /* move the back button to the left */
}

.export-button-container .btn-success {
    margin-top: 0; /* remove top margin */
    margin: 10px auto; /* center the export button and add some space */
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

        @media (max-width: 992px) {
        .sidebar {
            width: 100px;
        }
        .content-container {
            margin-left: 100px;
        }
        

        .instructor-label{
            margin-left: 50px;
            }
    }

    /* For screens smaller than 768px */
        @media (max-width: 768px) {
            .sidebar {
                width: 80px;
            }
            .content-container {
                margin-left: 80px;
            }
            
            .dropdown-content {
                min-width: 150px;
            }

            .filter-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin: 20px auto; /* add some margin top and bottom, and center it horizontally */
            }
            .filter-container label, .filter-container select, .filter-container input[type="submit"] {
                width: 100%; /* make them full width */
                margin-bottom: 10px; /* add some margin bottom */
            }

            .instructor-label{
            margin-left: 0px;
            }
        }

        /* For screens smaller than 480px */
        @media (max-width: 480px) {
            .sidebar {
                width: 60px;
            }
            .content-container {
                margin-left: 60px;
            }
            
            .dropdown-content {
                min-width: 100px;
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

    <div class="container">
        <h2 align="center">Class Lists of Courses</h2>
        <form method="get" action="{{ route('classlist.show') }}" align="center">
            <div class="filter-container">
                <label for="courseID">Course:</label>
                <select id="courseID" name="courseID" required>
                    <option value="">Select a Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->CourseID }}" {{ request('courseID') == $course->CourseID ? 'selected' : '' }}>
                            {{ $course->CourseID }} - {{ $course->Description }}
                        </option>
                    @endforeach
                </select>
                
                <label for="instructorID" class="instructor-label">Instructor:</label>
                <select id="instructorID" name="instructorID" required>
                    <option value="all" {{ request('instructorID') == 'all' ? 'selected' : '' }}>All Instructors</option>
                    <!-- Instructors will be populated here by JavaScript -->
                </select>
                
                <input type="submit" value="View Class List" class="btn btn-primary">
            </div>
        </form>
        <br />
        
        @if (!empty($students))
            <div class="table-responsive" id="classlist_table">
                <table class="table table-bordered">
                    <tr>
                        <th>Student ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->StudentID }}</td>
                            <td>{{ $student->FirstName }}</td>
                            <td>{{ $student->LastName }}</td>
                            <td>{{ $student->Email }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="export-button-container">
                <a href="{{ route('admin.masterlistDashboard')}}" class="btn btn-secondary">Back</a>
                <form method="post" action="{{ route('classlist.export') }}" align="center">
                    @csrf
                    <input type="hidden" name="courseID" value="{{ request('courseID') }}">
                    <input type="hidden" name="instructorID" value="{{ request('instructorID') }}">
                    <input type="submit" name="export" value="Export Classlist to CSV" class="btn btn-success">
                </form>
                
            </div>
        @elseif (request('courseID'))
            <p align="center">No students are enrolled in this course.</p>
        @endif
        
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
        $(document).ready(function() {
            $('#courseID').change(function() {
                var courseID = $(this).val();
                if (courseID) {
                    $.ajax({
                        url: "{{ route('classlist.fetchInstructors') }}",
                        type: "GET",
                        data: { courseID: courseID },
                        success: function(data) {
                            $('#instructorID').empty().append('<option value="all">All Instructors</option>');
                            $.each(data, function(index, instructor) {
                                $('#instructorID').append(
                                    '<option value="' + instructor.InstructorID + '">' + instructor.FirstName + ' ' + instructor.LastName + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('#instructorID').empty().append('<option value="all">All Instructors</option>');
                }
            });

          
            if ($('#courseID').val()) {
                $('#courseID').change();
            }
        });
    </script>
</body>
</html>

