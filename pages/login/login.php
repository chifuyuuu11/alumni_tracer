<?php
require '../../includes/conn.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign In</title>
  <link rel="icon" type="image/x-icon" href="../../dist/img/sfac.png">
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
        <p><h5>Alumni Tracking System</h5></p>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to your account.</p>
        <form action="usersData/ctrl.login.php" method="POST">
          <div class="input-group mb-3">
            <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
            <p class="error username-error"></p>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-1">
            <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
            <p class="error password-error"></p>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p class="mb-4">
            <a href="forgot.password.php">I forgot my password</a>
          </p>
          <div class="row mb-1">
            <!-- /.col -->
            <div class="input-group col-md-12">
              <!-- <a href="../registration/add.registration.php" name="signin" class="btn btn-default">Register</a> -->
              <button type="submit" name="signin" class="btn-block btn btn-primary">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          <p class="mb-3 text-center">
<<<<<<< HEAD
            Are you an alumni? <a href="../registration/alumni.registration.php">Register here.</a>
=======
            Are you an alumni? <a href="../registration/add.registration.php">Register here.</a>
>>>>>>> 7bbf87c64ee6fb625b5a1a981f8047b6e96887b6
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