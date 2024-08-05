<?php
session_start();
require '../../includes/conn.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alumni Tracer | Online Registration</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition login-page">
  <div class="register-box">
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
        <p class="login-box-msg">Fill up this form to register.</p>

        <form action="usersData/ctrl.add.registration.php" method="POST">
          <div class="row">
            <div class="col-md-4 form-group mb-3">
              <label>First Name</label>
              <input type="text" name="firstname" class="form-control">

            </div>
            <div class="col-md-4 form-group mb-3">
              <label>Middle Name</label>
              <input type="text" name="middlename" class="form-control">

            </div>
            <div class="col-md-4 form-group mb-3">
              <label>Last Name</label>
              <input type="text" name="lastname" class="form-control">

            </div>
          </div>
          <div class="row">
            <div class="col-md-6 form-group mb-3">
              <label for="role">Role</label>
              <select required class="form-control select2" id="role" name="role">
                <option value="" disabled selected>Select Role</option>
                <?php
                $select_role = mysqli_query($conn, "SELECT * FROM tbl_roles");
                while ($row = mysqli_fetch_array($select_role)) {
                  ?>
                  <option value="<?php echo $row['role_id'] ?>"><?php echo $row['role'] ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="col-md-6 form-group mb-3">
            <label for="gender">Gender</label>
              <select required class="form-control select2" id="gender" name="gender">
                <option value="" disabled selected>Select Gender</option>
                <?php
                $select_role = mysqli_query($conn, "SELECT * FROM tbl_genders");
                while ($row = mysqli_fetch_array($select_role)) {
                  ?>
                  <option value="<?php echo $row['gender_id'] ?>"><?php echo $row['gender'] ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-8 form-group mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control">

            </div>
            <div class="col-md-4 form-group mb-3">
              <label>Contact Number</label>
              <input type="text" name="contact_no" class="form-control">

            </div>
          </div>
          <div class="row mt-3">
            <div class="col">
              <div class="icheck-primary">
                <input type="checkbox" id="remember" required>
                <label for="remember">
                  I agree that the data collected from this online registration shall be subjected to the school's <a class="text-primary">Data Privacy Policy</a>.
                </label>
              </div>
            </div>
          </div>
            <!-- /.col -->
          <div class="row mt-3 float-right">
            <div class="col-auto">
              <a href="../login/login.php" class="btn btn-danger">Log In</a>
              <button type="submit" name="submit" class="btn btn-primary">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <?php
  ?>
  <!-- jQuery -->
  <script src="../../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../../dist/js/adminlte.min.js"></script>
  <!-- Toastr -->
  <script src="../../plugins/toastr/toastr.min.js"></script>
  <script>
    <?php
      if ($_SESSION['success_register']) {
    ?>
    toastr.success('Registration Success!<p><strong> Please wait for the email.</strong></p>');
    <?php
      }

      unset($_SESSION['success_register']);
    ?>
  </script>
</body>

</html>