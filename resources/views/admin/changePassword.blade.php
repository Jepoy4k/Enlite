<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
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

.container {
            /* background-color: #fff; */
            padding: 20px;
            border-radius: 5px;
            /* box-shadow: 0 0 10px rgba(0,0,0,0.1); */
}
h2 {
    margin-bottom: 20px;
}
h1.mb-4 {
  text-align: center;
  margin-top: 20px;
}

.form-group {
    margin-bottom: 20px;
}
label {
    font-weight: bold;
    margin-left: 10px;
}
.form-container {
    margin: 50px auto;
    background-color: #eeebebac;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 80%;
    height: 500px;
}


label {
    font-weight: bold;
}

.input-group {
    position: relative;
    padding: 0px 20px;
}

.input-group-append {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 2;
    display: flex;
    align-items: center;
    padding: 0 25px;
    border-radius: 0 10px 10px 0;
    background-color: #fff;
    border: 1px solid #ddd;

}

.toggle-password {
    cursor: pointer;
    background-color: none;
}

.password-icon {
    font-size: 20px;
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
.input-group-append {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    z-index: 100;
    background-color: none;
    border: none;
    background-color: transparent;
}

.password-icon {
    font-size: 20px;
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
    <div class="container mt-5">
        <div class="form-container">
            <h1 class="mb-4">Change Password</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            <form id="change-password-form" action="{{ route('profile.changePassword') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <span class="input-group-append">
                            <ion-icon name="eye-outline" class="password-icon"></ion-icon>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                        <span class="input-group-append">
                            <ion-icon name="eye-outline" class="password-icon"></ion-icon>
                        </span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        <span class="input-group-append">
                            <ion-icon name="eye-outline" class="password-icon"></ion-icon>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
            </form>
        </div>
    </div>
        

    
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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
        // Handle form submission
        $('#change-password-form').submit(function(event) {
            // Perform AJAX submission
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Display success message
                    $('#success-message').show();

                    // Hide success message after 5 seconds and redirect
                    setTimeout(function() {
                        $('#success-message').hide();
                        window.location.replace("{{ route('admin.dashboard') }}"); // Redirect to admin dashboard
                    }, 5000); // Hide after 5 seconds
                }
            });
        });
    });

    const passwordIcons = document.querySelectorAll('.password-icon');

passwordIcons.forEach(icon => {
    icon.addEventListener('click', () => {
        const inputField = icon.parentNode.parentNode.querySelector('input');
        const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
        inputField.setAttribute('type', type);
        icon.name = type === 'password' ? 'eye-outline' : 'eye-off-outline';
    });
});
    </script>
</body>

</html>
