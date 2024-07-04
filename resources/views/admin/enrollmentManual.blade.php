<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/ionicons@5.5.2/dist/ionicons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <title>Enroll Students</title>
<style>
    body {
    display: flex;
    height: 120vh;
    width: 100vw;
    margin: 0;
    font-family: Arial, sans-serif;
    justify-content: center;
    align-items: center;
    }

    /* Sidebar styles */ 
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

    /* Main content area */
    .main-content {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        margin-top: 4rem;
        padding: 20px;
    }

    .form-container {
        margin: 4rem auto;
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

    /* Responsive styles */

    @media (max-width: 1200px){
    .form-container {
        margin-top: 150px;
    }
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

        .main-content {
            margin-top: 0;
        }

        .form-container {
            width: 100%;
            padding: 10px;
        }
        }

        @media (max-width: 890px) {
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
            .form-container {
                width: 90%;
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

        

    </div>

    <div class="form-container">
        <h2>Student Enrollment Form</h2>
        
        <!-- Success message -->
        @if(session('success'))
            <div class="alert alert-success">
                <ion-icon name="checkmark-circle" style="color: #1a592a; font-size: 20px; vertical-align: middle;"></ion-icon>
                {{ session('success') }}
            </div>
        @endif

        {{-- Already Enrolled message --}}
        @if(session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
            @endif
        
        {{-- Form --}}
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="Year_SemID">Year Semester:</label>
                <select class="form-control" id="Year_SemID" name="Year_SemID" required>
                    @foreach($yearSemesters as $yearSemester)
                        <option value="{{ $yearSemester->Year_SemID }}">{{ $yearSemester->YearLevel }} - {{ $yearSemester->Sem }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="StudentIDInput">Student ID:</label>
                <input type="text" class="form-control" id="StudentIDInput" name="StudentIDInput" placeholder="Type student ID" required>
                <input type="hidden" id="StudentID" name="StudentID">
            </div>
            <div class="form-group">
                <label for="StudentName">Student Name:</label>
                <input type="text" class="form-control" id="StudentName" name="StudentName" placeholder="Input Student ID" readonly>
            </div>
            <div class="form-group">
                <label for="CourseIDInput">Course ID:</label>
                <input type="text" class="form-control" id="CourseIDInput" name="CourseIDInput" placeholder="Type course ID" required>
                <input type="hidden" id="CourseID" name="CourseID">
            </div>
            <div class="form-group">
                <label for="CourseName">Course Description:</label>
                <input type="text" class="form-control" id="CourseName" name="CourseName" placeholder="Input Course ID" readonly>
            </div>
            <div class="form-group">
                <label for="InstructorID">Instructor:</label>
                <select class="form-control" id="InstructorID" name="InstructorID" required>
                    <option value="">Select Instructor</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Course_InstructorID">Course Instructor ID:</label>
                <input type="text" class="form-control" id="Course_InstructorID" name="Course_InstructorID" placeholder="Select Course and Instructor" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary">Enroll</button>
        </form>
    </div>

    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        // script for nav burger menu
        document.getElementById('burger-menu').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // script for dropdown profile
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

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        //scripts for form
        $(document).ready(function() {
            console.log('Document ready.');

            // Autocomplete for Student ID
            $('#StudentIDInput').autocomplete({
                source: function(request, response) {
                    console.log('Autocomplete request for StudentID:', request.term);
                    $.ajax({
                        url: '{{ route("students.filter") }}',
                        type: 'GET',
                        data: { StudentID: request.term },
                        success: function(data) {
                            console.log('Autocomplete success for StudentID:', data);
                            response($.map(data, function(student) {
                                return {
                                    label: student.StudentID + " - " + student.FirstName + " " + student.LastName,
                                    value: student.StudentID,
                                    studentName: student.FirstName + " " + student.LastName
                                };
                            }));
                        },
                        error: function(xhr, status, error) {
                            console.log('Autocomplete AJAX Error:', error);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#StudentID').val(ui.item.value);
                    $('#StudentName').val(ui.item.studentName);
                },
                minLength: 2
            });

            // Autocomplete for Course ID
            $('#CourseIDInput').autocomplete({
                source: function(request, response) {
                    console.log('Autocomplete request for CourseID:', request.term);
                    $.ajax({
                        url: '{{ route("courses.filter") }}',
                        type: 'GET',
                        data: { CourseID: request.term },
                        success: function(data) {
                            console.log('Autocomplete success for CourseID:', data);
                            response($.map(data, function(course) {
                                return {
                                    label: course.CourseID + " - " + course.Description,
                                    value: course.CourseID,
                                    courseDescription: course.Description
                                };
                            }));
                        },
                        error: function(xhr, status, error) {
                            console.log('Autocomplete AJAX Error:', error);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#CourseID').val(ui.item.value);
                    $('#CourseName').val(ui.item.courseDescription);

                    // Fetch instructors for the selected course
                    $.ajax({
                        url: '{{ route("course.instructors") }}',
                        type: 'GET',
                        data: { CourseID: ui.item.value },
                        success: function(data) {
                            console.log('Fetch Instructors success:', data);
                            $('#InstructorID').empty(); // Clear current options
                            $('#InstructorID').append($('<option>').text('Select Instructor').attr('value', ''));
                            $.each(data, function(index, instructor) {
                                $('#InstructorID').append($('<option>').text(instructor.FirstName + ' ' + instructor.LastName).attr('value', instructor.InstructorID));
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log('Fetch Instructors AJAX Error:', error);
                        }
                    });
                }
            });

            // On change event for Instructor ID
            $('#InstructorID').change(function() {
                var courseID = $('#CourseID').val();
                var instructorID = $(this).val();

                // Fetch Course Instructor ID based on Course ID and Instructor ID
                $.ajax({
                    url: '{{ route("course.instructor.by.course.instructor") }}',
                    type: 'GET',
                    data: { CourseID: courseID, InstructorID: instructorID },
                    success: function(data) {
                        console.log('Fetch Course Instructor success:', data);
                        $('#Course_InstructorID').val(data.Course_InstructorID);
                    },
                    error: function(xhr, status, error) {
                        console.log('Fetch Course Instructor AJAX Error:', error);
                    }
                });
            });

            // Autocomplete for Course Instructor ID
            $('#Course_InstructorIDInput').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route("course_instructors.filter") }}',
                        type: 'GET',
                        data: { term: request.term },
                        success: function(data) {
                            console.log('Autocomplete success for Course Instructor:', data);
                            response($.map(data, function(courseInstructor) {
                                return {
                                    label: courseInstructor.Course_InstructorID + " - " + courseInstructor.instructor.FirstName + " " + courseInstructor.instructor.LastName,
                                    value: courseInstructor.Course_InstructorID,
                                    courseID: courseInstructor.course.CourseID,
                                    instructorName: courseInstructor.instructor.FirstName + " " + courseInstructor.instructor.LastName
                                };
                            }));
                        },
                        error: function(xhr, status, error) {
                            console.log('Autocomplete AJAX Error:', error);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#Course_InstructorID').val(ui.item.value);
                    $('#CourseID').val(ui.item.courseID);
                    $('#InstructorName').val(ui.item.instructorName);
                },
                minLength: 2
            });

            // Form submission handling
            $('form').submit(function(event) {
                // event.preventDefault(); // Prevent default form submission for testing

                console.log('Form submitted.');

                // Validate that hidden fields are correctly populated
                console.log('StudentID:', $('#StudentID').val());
                console.log('CourseID:', $('#CourseID').val());
                console.log('InstructorID:', $('#InstructorID').val());
                console.log('Course_InstructorID:', $('#Course_InstructorID').val());

                // Uncomment below to submit form for actual test
                // this.submit();
            });

            // Initial AJAX call
            $.ajax({
                url: '{{ route("courses.filter") }}',
                type: 'GET',
                success: function(data) {
                    console.log('Initial AJAX success:', data);
                    response($.map(data, function(course) {
                        return {
                            label: course.CourseID + " - " + course.CourseName,
                            value: course.CourseID,
                            courseName: course.CourseName
                        };
                    }));
                },
                error: function(xhr, status, error) {
                    console.log('Initial AJAX Error:', error);
                }
            });

        });
    </script>
</body>

</html>



