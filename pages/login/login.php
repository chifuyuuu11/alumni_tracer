<?php
require '../../includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <style>
    .login-page {
      background-image: url('../../dist/img/bg.jpg');
      background-size: cover;
    }

    .card {
      background-image: url("../../dist/img/white.jpg");
      height: 460px;
      width: 350px;
      border-radius: 15px;
      overflow: auto;
      object-fit: fill;
    }
    
    .error {
      color: red;
    }

    .error input {
      border-color: red;
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="row justify-content-center">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-danger">
        <div class="card-header text-center">
          <div class="sfac-logo">
            <img src="../../dist/img/sfac.png" alt="sfac" style="width:80px;height:80px;">
          </div>
          <a href="https://stfrancis.edu.ph/" style="color: black;">
            <h4><b>Saint Francis of Assisi College</b></h4>
          </a>
          <p>Online Alumni Tracking System</p>
        </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col-auto"></div>
              <div class="col">
                <p class="login-box-msg">Sign in to your account.</p>
                <form id="loginForm" action="usersData/ctrl.login.php" method="POST">
                  <div class="input-group mb-3">
                    <input type="text" id="username" class="form-control" name="username" placeholder="Username"
                      required>
                    <p class="error username-error"></p>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="input-group mb-3">
                    <input type="password" id="password" class="form-control" name="password" placeholder="Password"
                      required>
                    <p class="error password-error"></p>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col"></div>
                    <!-- /.col -->
                    <div class="col-md-auto">
                      <a href="../registration/add.registration.php" name="signin" class="btn btn-primary ">Register</a>
                      <button type="submit" name="signin" class="btn btn-danger">Sign In</button>
                      <p class="success-message"></p>
                    </div>
                    <!-- /.col -->
                  </div>
                  <p class="mb-1">
                    <a href="forgot.password.php">I forgot my password</a>
                  </p>
                </form>
                <?php
                session_start();
                if (isset($_SESSION['error'])) {
                  $error = $_SESSION['error'];
                  echo "<script>
                    document.addEventListener('DOMContentLoaded', function() {
                      toastr.options = {
                        'closeButton': true,
                        'debug': false,
                        'newestOnTop': false,
                        'progressBar': true,
                        'positionClass': 'toast-top-right',
                        'preventDuplicates': false,
                        'onclick': null,
                        'showDuration': '300',
                        'hideDuration': '1000',
                        'timeOut': '5000',
                        'extendedTimeOut': '1000',
                        'showEasing': 'swing',
                        'hideEasing': 'linear',
                        'showMethod': 'fadeIn',
                        'hideMethod': 'fadeOut'
                      };
                      if ('$error' == 'wrong_username') {
                        toastr.error('Invalid username.');
                      } else if ('$error' == 'wrong_password') {
                        toastr.error('Incorrect password.');
                      }
                    });
                  </script>";
                  unset($_SESSION['error']);
                }
                ?>
                <?php
                if (isset($_GET['password_reset']) && $_GET['password_reset'] == 'success') {
                  echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                    toastr.options = {
                      'closeButton': true,
                      'debug': false,
                      'newestOnTop': false,
                      'progressBar': true,
                      'positionClass': 'toast-top-right',
                      'preventDuplicates': false,
                      'onclick': null,
                      'showDuration': '300',
                      'hideDuration': '1000',
                      'timeOut': '8000',
                      'extendedTimeOut': '1000',
                      'showEasing': 'swing',
                      'hideEasing': 'linear',
                      'showMethod': 'fadeIn',
                      'hideMethod': 'fadeOut'
                    };
                    toastr.success('Your password has successfully been updated!');
                  });!');
                </script>";
                }
                ?>

              </div>
            </div>
          </div>
          <p class="mb-0"></p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Toastr -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>

</html>