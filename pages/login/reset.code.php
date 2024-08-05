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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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
          <h5>Code Verification</h5>
    </div>
    <div class="card-body">
      <form action="usersData/ctrl.forget.password.php" method="post">
        <div class="input-group mb-3">
          <input type="number" name="otp" class="form-control" placeholder="Enter One Time Password" required>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="reset-otp" class="btn btn-danger btn-block">Submit</button>
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
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<?php
if (isset($_GET['invalid_otp']) && $_GET['invalid_otp'] == 'true') {
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
        toastr.error('Invalid OTP!');
      });
    </script>";
}
?>

</body>
</html>
