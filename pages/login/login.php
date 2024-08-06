<?php
require '../../includes/conn.php';
session_start();
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
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <!-- Bootstrap 4 -->
  <link rel="stylesheet" href="../../plugins/bootstrap/css/bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
  <style>
    .login-page {
      background-image: url('../../dist/img/bg.jpg');
      background-size: cover;
    }

    .card {
      background-image: url("../../dist/img/white.jpg");
    }
  </style>
</head>

<body class="hold-transition login-page">
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
        <p class="login-box-msg">Sign in to your account.</p>
        <form action="usersData/ctrl.login.php" method="POST">
          <div class="input-group mb-3">
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
            <p class="error username-error"></p>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
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
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Toastr -->
  <script src="../../plugins/toastr/toastr.min.js"></script>
  <script>
    <?php
    if (isset($_SESSION['password_success'])) {
    ?>
      $(function() {
        toastr.success('Password successfully changed!', 'Success')
      });
    <?php
    } elseif (isset($_SESSION['error'])) {
    ?>
      $(function() {
        toastr.error('<?php echo $_SESSION['error']?>!', 'Error')
    });
    <?php
    }

    ///UNSET SESSION NOTIFS
    unset($_SESSION['password_success']);
    unset($_SESSION['error']);
    ?>
  </script>
</body>

</html>