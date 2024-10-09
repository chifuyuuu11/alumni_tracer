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
  <?php require '../../includes/link.php'; ?>
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
            <div class="form-group col-md-4">
              <label for="firstname">Highest Level Attained at SFAC</label>
              <select required class="form-control select2" id="attained" name="attained">
                <option disabled selected>Highest Level Attained at SFAC</option>

                <?php
                $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained_id = '$row[attained_id]'");
                while ($row1 = mysqli_fetch_array($select_attained)) {
                  ?>

                  <?php
                }
                ?>
                <?php
                $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE NOT attained_id = '$row[attained_id]'");
                while ($row1 = mysqli_fetch_array($select_attained)) {
                  ?>
                  <option value="<?php echo $row1['attained_id'] ?>"><?php echo $row1['attained'] ?>
                  </option>
                  <?php
                }
                ?>

              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="firstname">Program</label>
              <select required class="form-control select2" id="program" name="program">
                <option disabled selected>Select Program</option>

                <?php
                $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_id = '$row[program_id]'");
                while ($row1 = mysqli_fetch_array($select_program)) {
                  ?>
                  <?php
                }
                ?>
                <?php
                $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE NOT program_id = '$row[program_id]'");
                while ($row1 = mysqli_fetch_array($select_program)) {
                  ?>
                  <option value="<?php echo $row1['program_id'] ?>"><?php echo $row1['program_desc'] ?>
                  </option>
                  <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="batch">Batch</label>
              <input type="number" class="form-control" id="batch" name="batch" placeholder="Batch" min="1000"
                max="9999" oninput="if(this.value.length > 4) this.value = this.value.slice(0, 4)">
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


            <div class="row mt-3">
              <div class="col">
                <div class="icheck-primary">
                  <input type="checkbox" id="remember" required>
                  <label for="remember">
                    I agree that the data collected from this online registration shall be subjected to the school's <a
                      class="text-primary">Data Privacy Policy</a>.
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
  <?php require '../../includes/script.php'; ?>
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