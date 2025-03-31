<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require_once ('connection.php');
    if(isset($_SESSION['username'])) {
        $username=$_SESSION['username'];
    } else {
        echo "<script>
        alert('please login ');
        window.location.href='../index.php';
        </script>";
        die();
    }
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Modern Resources -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Add jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Add these styles after your existing styles in the <style> section -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f3f4f6;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 78px;
            background: #11101d;
            padding: 6px 14px;
            transition: all 0.5s ease;
            z-index: 99;
        }

        .sidebar.active {
            width: 240px;
        }

        .sidebar .logo {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .logo img {
            width: 60px;
            transition: all 0.5s ease;
        }

        .sidebar.active .logo img {
            width: 80px;
        }

        .sidebar .nav-links {
            margin-top: 20px;
            height: 100%;
            padding: 0;
        }

        .sidebar .nav-links li {
            position: relative;
            list-style: none;
            height: 50px;
            margin: 10px 0;
        }

        .sidebar .nav-links li a {
            height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            border-radius: 12px;
        }

        .sidebar .nav-links li a:hover {
            background: #1d1b31;
        }

        .sidebar .nav-links li a i {
            min-width: 50px;
            text-align: center;
            height: 50px;
            line-height: 50px;
            color: #fff;
            font-size: 20px;
        }

        .sidebar .nav-links li a .link-name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s;
        }

        .sidebar.active .nav-links li a .link-name {
            opacity: 1;
            pointer-events: auto;
        }

        .user-profile {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 78px;
            padding: 10px;
            background: #1d1b31;
            transition: all 0.5s ease;
            overflow: hidden;
        }

        .sidebar.active .user-profile {
            width: 240px;
        }

        .user-profile .profile-details {
            display: flex;
            align-items: center;
            opacity: 1;  /* Changed from 0 to 1 */
            white-space: nowrap;
            color: #fff;
            gap: 10px;
        }

        .sidebar.active .user-profile .profile-details {
            opacity: 1;
            pointer-events: auto;
        }

        .user-profile img {
            height: 35px;
            width: 35px;
            object-fit: cover;
            border-radius: 8px;
            display: block;  /* Added to ensure image is always visible */
        }

        .logout-btn {
            color: #fff;
            font-size: 18px;
            text-align: center;
            display: block;
            margin-top: 10px;
            padding: 5px;
        }

        .logout-btn:hover {
            background: #FF6B6B;
            border-radius: 12px;
        }

        /* Updated main-content styles for better compatibility */
        #main-content {
            position: relative;
            min-height: 100vh;
            margin-left: 78px;
            padding: 15px;
            transition: all 0.5s ease;
            background: #fff;
        }

        .sidebar.active ~ #main-content {
            margin-left: 240px;
        }

        /* Fix for existing Bootstrap components */
        .container-fluid {
            padding: 15px;
            width: 100%;
        }

        .panel {
            margin-bottom: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }

        /* Ensure tables and forms maintain their layout */
        .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        /* Fix for form elements */
        .form-control {
            max-width: 100%;
        }

        /* Fix for panels and cards */
        .card, .panel {
            margin: 15px 0;
        }
    </style>

    <!-- Add this right before closing </head> tag -->
    <script>
        // Ensure proper content loading
        window.addEventListener('load', function() {
            // Fix any layout issues after page load
            setTimeout(function() {
                window.dispatchEvent(new Event('resize'));
            }, 300);
        });
    </script>
    <!-- After your existing jQuery and Bootstrap JS links, add this -->
    <script>
    <!-- Remove the nested script tags and fix the structure -->
    <script>
    $(document).ready(function(){
        // Initialize Bootstrap dropdowns
        $('[data-toggle="dropdown"]').dropdown();
    });
    </script>
    </script>
</head>

<body>
    <!-- Update the main-content div structure -->
    <div class="sidebar">
        <div class="logo">
            <img src="images/dlogo.png" alt="Logo">
        </div>
        <ul class="nav-links">
            <li>
                <a href="user_dashboard.php">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="van.php">
                    <i class="fa-solid fa-location-dot"></i>
                    <span class="link-name">Site Locations</span>
                </a>
            </li>
            <li>
                <a href="help.php">
                    <i class="fa-solid fa-handshake-angle"></i>
                    <span class="link-name">Help Center</span>
                </a>
            </li>
            <li>
                <a href="add_site.php">
                    <i class="fa-solid fa-plus"></i>
                    <span class="link-name">Add Site</span>
                </a>
            </li>
            <li>
                <a href="add_help.php">
                    <i class="fa-solid fa-hospital"></i>
                    <span class="link-name">Add Help Center</span>
                </a>
            </li>
            <li>
                <a href="predictions.php">
                    <i class="fa-solid fa-chart-line"></i>
                    <span class="link-name">Predictions</span>
                </a>
            </li>
        </ul>
        <div class="user-profile">
            <div class="profile-details">
                <img src="images/adminn.png" alt="profile">
                <span><?php echo $username; ?></span>
            </div>
            <a href="logout.php" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i>
            </a>
        </div>
    </div>

    <div id="main-content">
        <div class="container-fluid">
            <!-- Your page content will be placed here -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            
            sidebar.addEventListener('mouseenter', () => {
                sidebar.classList.add('active');
            });
            
            sidebar.addEventListener('mouseleave', () => {
                sidebar.classList.remove('active');
            });
        });
    </script>
</body>
</html>