<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Disaster Management System Login">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="">
  <title>Disaster Management System</title>
  <!-- Bootstrap Core CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #0057b8;
      --secondary-color: #005eff;
      --accent-color: #ff3c00;
      --dark-color: #1a1a1a;
      --light-color: #f8f9fa;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      height: 100vh;
    }
    
    .login-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(0, 87, 184, 0.9), rgba(0, 31, 63, 0.85)), url('login.jpeg');
      background-size: cover;
      background-position: center;
      filter: brightness(0.9);
      z-index: -1;
    }
    
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
    }
    
    .login-wrapper {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    
    .login-box {
      max-width: 450px;
      width: 100%;
      margin: 0 auto;
    }
    
    .white-box {
      background-color: rgba(255, 255, 255, 0.95);
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      padding: 40px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
      backdrop-filter: blur(5px);
    }
    
    .white-box:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }
    
    .system-logo {
      text-align: center;
      margin-bottom: 20px;
    }
    
    .logo-icon {
      font-size: 3rem;
      color: var(--primary-color);
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.05);
      }
      100% {
        transform: scale(1);
      }
    }
    
    .box-title {
      color: var(--dark-color);
      font-weight: 600;
      margin-bottom: 30px;
      text-align: center;
      font-size: 1.8rem;
    }
    
    .form-floating {
      margin-bottom: 20px;
    }
    
    .form-control {
      height: 55px;
      border-radius: 10px;
      border: 1px solid #dde2e6;
      padding: 10px 15px;
      font-size: 16px;
      transition: all 0.3s;
      background-color: rgba(255, 255, 255, 0.8);
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(0, 87, 184, 0.25);
    }
    
    .form-floating label {
      padding: 1rem 1rem;
    }
    
    .btn-login {
      height: 55px;
      border-radius: 10px;
      font-size: 16px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
      background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
      border: none;
      color: white;
      transition: all 0.3s;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }
    
    .btn-login:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
      transition: all 0.6s;
      z-index: -1;
    }
    
    .btn-login:hover:before {
      left: 100%;
    }
    
    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 87, 184, 0.3);
    }
    
    .emergency-text {
      color: var(--accent-color);
      font-weight: 600;
      animation: fadeInOut 2s infinite;
      margin-top: 20px;
      text-align: center;
    }
    
    @keyframes fadeInOut {
      0% { opacity: 0.7; }
      50% { opacity: 1; }
      100% { opacity: 0.7; }
    }
    
    .input-icon {
      position: absolute;
      top: 19px;
      left: 15px;
      color: var(--primary-color);
    }
    
    .disaster-animation {
      position: absolute;
      width: 100%;
      height: 100px;
      bottom: 0;
      left: 0;
      background: url('https://api.placeholder.com/1200/300') center/cover;
      opacity: 0.2;
    }
    
    .loader {
      display: inline-block;
      width: 80px;
      height: 80px;
    }
    
    .loader:after {
      content: " ";
      display: block;
      width: 64px;
      height: 64px;
      margin: 8px;
      border-radius: 50%;
      border: 6px solid var(--primary-color);
      border-color: var(--primary-color) transparent var(--primary-color) transparent;
      animation: loader 1.2s linear infinite;
    }
    
    @keyframes loader {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    
    .preloader {
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 9999;
      background: rgba(255, 255, 255, 0.95);
      display: flex;
      justify-content: center;
      align-items: center;
    }
    
    .wave {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100px;
      background: url('https://api.placeholder.com/400/200');
      background-size: 1000px 100px;
    }
    
    .wave.wave1 {
      animation: animate 30s linear infinite;
      z-index: 1000;
      opacity: 0.5;
      animation-delay: 0s;
      bottom: 0;
    }
    
    @keyframes animate {
      0% { background-position-x: 0; }
      100% { background-position-x: 1000px; }
    }
  </style>
</head>

<body>
  <!-- Preloader -->
  <div class="preloader">
    <div class="loader"></div>
  </div>
  
  <!-- Background Elements -->
  <div class="login-background"></div>
  <div id="particles" class="particles"></div>
  
  <div class="login-wrapper">
    <div class="login-box">
      <div class="white-box animate__animated animate__fadeIn">
        <!-- Logo and Title -->
        <div class="system-logo">
          <i class="fas fa-shield-alt logo-icon"></i>
        </div>
        
        <h3 class="box-title">Disaster Management System</h3>
        
        <!-- Login Form -->
        <form class="form-material" id="loginform" action="admin_login_back.php" method="POST">
          
          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            <label for="username"><i class="fas fa-user me-2"></i> Username</label>
          </div>
          
          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password"><i class="fas fa-lock me-2"></i> Password</label>
          </div>
          
          <div class="d-grid">
            <button class="btn btn-login animate__animated animate__pulse animate__infinite" name="login" type="submit">
              <i class="fas fa-sign-in-alt me-2"></i> Secure Login
            </button>
          </div>
          
          <p class="emergency-text mt-4">
            <i class="fas fa-exclamation-triangle me-2"></i> Emergency Response System
          </p>
        </form>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
  
  <script>
    // Preloader
    $(window).on('load', function() {
      $('.preloader').fadeOut(1000);
    });
    
    // Initialize particles.js
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof particlesJS !== 'undefined') {
        particlesJS('particles', {
          "particles": {
            "number": {
              "value": 80,
              "density": {
                "enable": true,
                "value_area": 800
              }
            },
            "color": {
              "value": "#ffffff"
            },
            "shape": {
              "type": "circle",
              "stroke": {
                "width": 0,
                "color": "#000000"
              },
            },
            "opacity": {
              "value": 0.5,
              "random": false,
            },
            "size": {
              "value": 3,
              "random": true,
            },
            "line_linked": {
              "enable": true,
              "distance": 150,
              "color": "#ffffff",
              "opacity": 0.4,
              "width": 1
            },
            "move": {
              "enable": true,
              "speed": 2,
              "direction": "none",
              "random": false,
              "straight": false,
              "out_mode": "out",
              "bounce": false,
            }
          },
          "interactivity": {
            "detect_on": "canvas",
            "events": {
              "onhover": {
                "enable": true,
                "mode": "repulse"
              },
              "onclick": {
                "enable": true,
                "mode": "push"
              },
              "resize": true
            },
          },
          "retina_detect": true
        });
      }
    });
    
    // Button hover animation
    const loginBtn = document.querySelector('.btn-login');
    if (loginBtn) {
      loginBtn.addEventListener('mouseover', function() {
        this.classList.add('animate__headShake');
        this.classList.remove('animate__pulse');
      });
      
      loginBtn.addEventListener('mouseout', function() {
        this.classList.remove('animate__headShake');
        this.classList.add('animate__pulse');
      });
    }
    
    // Form animations
    const formElements = document.querySelectorAll('.form-control');
    formElements.forEach(element => {
      element.addEventListener('focus', function() {
        this.parentElement.classList.add('animate__animated', 'animate__pulse');
      });
      
      element.addEventListener('blur', function() {
        this.parentElement.classList.remove('animate__animated', 'animate__pulse');
      });
    });
  </script>
</body>
</html>