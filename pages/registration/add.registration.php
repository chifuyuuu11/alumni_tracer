<?php
session_start();
require '../../includes/conn.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online Registration</title>
  <link rel="icon" type="image/x-icon" href="../../dist/img/sfac.png">

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

        <form id="regform" action="usersData/ctrl.add.registration.php" method="POST">
          <div class="row">
            <div class="col-md-4 form-group mb-3">
              <label>First Name</label>
              <input type="text" name="firstname" placeholder="First Name" class="form-control" required>

            </div>
            <div class="col-md-4 form-group mb-3">
              <label>Middle Name</label>
              <input type="text" name="middlename" placeholder="Middle Name" class="form-control">

            </div>
            <div class="col-md-4 form-group mb-3">
              <label>Last Name</label>
              <input type="text" name="lastname" placeholder="Last Name" class="form-control" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-sm-12 col-md-4">
              <label for="firstname">Highest Level Attained at SFAC</label>
              <select required class="form-control select2" id="attained" onchange="programSelect()" name="attained">
                <option disabled selected>Highest Level Attained at SFAC</option>
                <?php
                $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained");
                while ($row1 = mysqli_fetch_array($select_attained)) {
                  ?>
                  <option class="<?php echo $row1['dept_id']?>" value="<?php echo $row1['attained_id']; ?>"><?php echo $row1['attained']; ?>
                  </option>
                  <?php
                }
                ?>

              </select>
            </div>
            <div class="form-group col-sm-12 col-md-4">
              <label for="firstname">Program</label>
              <select required class="form-control select2" id="program" name="program">
                <option class="0" disabled selected>Select Program</option>
                <?php
                $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs");
                while ($row1 = mysqli_fetch_array($select_program)) {
                  ?>
                  <option class="<?php echo $row1['dept_id']?>" value="<?php echo $row1['program_id'] ?>"><?php echo $row1['program_desc'] ?>
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
            <div class="col-md-8 form-group mb-1">
              <label>Email</label>
              <input type="email" oninput="checkEmail()" id="email" name="email" placeholder="Email" class="form-control" required>
              <small><span id="message" style="color:red"></span></small>
            </div>
            <div class="col-md-4 form-group mb-1">
              <label>Contact Number</label>
              <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number"
                min="00000000000001" max="9999999999999"
                oninput="if(this.value.length > 13) this.value = this.value.slice(0, 13)" required>

            </div>
          </div>

          <div class="row mb-3">
            <div class="col-12"> 
              <div class="icheck-primary">
                <input type="checkbox" id="remember" name="yamete" required>
                <label for="remember">
                  I agree that the data collected from this online registration shall be subjected to the school's <a href=""
                    class="text-primary">Data Privacy Policy</a>.
                </label>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="row mb-1 justify-content-center">
            <div class="col-md-auto">
              <button type="submit" id="submit" name="submit" class="btn btn-primary">Register</button>
            </div>
            <!-- /.col -->
          </div>
          <p class="mb-4 text-center">
            Already have an account? <a href="../login/login.php">Sign in here.</a>
          </p>
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
</body>

</html>