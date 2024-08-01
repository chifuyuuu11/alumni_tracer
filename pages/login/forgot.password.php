<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Forgot Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <style>
    .login-page {
      background-image: url('../../dist/img/bg.jpg');
      background-size: cover;
    }
    .card {
      background-image: url("../../dist/img/white.jpg");
      border-radius: 15px;
    }
  </style>

</head>
<body class="hold-transition login-page">
<div class="login-box">
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
      <p class="login-box-msg">Enter your registered email address to retrieve a new password for your account.</p>
      <form action="usersData/ctrl.forget.password.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="forgotpassword" class="btn btn-danger btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="login.php">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>

</body>
</html>
