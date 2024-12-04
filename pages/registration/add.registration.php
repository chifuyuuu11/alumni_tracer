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
  
  <script>
    function showOptions() {
      var gradeSelect = document.getElementById("attained");
      var combinedSelect = document.getElementById("select_combined");

      // Clear previous options
      combinedSelect.innerHTML = '';

      // Create a placeholder option
      var placeholderOption = document.createElement("option");
      placeholderOption.value = "";
      placeholderOption.disabled = true;
      placeholderOption.selected = true;
      placeholderOption.text = "Select Strand/Program"; 
      combinedSelect.add(placeholderOption); 

      if (gradeSelect.value === "2") {
        var strands = <?php
          $select_strand = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = 4;");
          $strands = [];
          while ($row = mysqli_fetch_array($select_strand)) {
            $strands[] = [
              'value' => $row['dept_id'],
              'desc' => $row['program_desc']
            ];
          }
          echo json_encode($strands);
        ?>;

        strands.forEach(function(strand) {
          var option = document.createElement("option");
          option.value = strand.value;
          option.text = strand.desc;
          combinedSelect.add(option);
        });
      } else if (gradeSelect.value === "3") {
        var programs = <?php
          $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = 5;");
          $programs = [];
          while ($row = mysqli_fetch_array($select_program)) {
            $programs[] = [
              'value' => $row['program_id'],
              'desc' => $row['program_desc']
            ];
          }
          echo json_encode($programs);
        ?>;

        programs.forEach(function(program) {
          var option = document.createElement("option");
          option.value = program.value;
          option.text = program.desc;
          combinedSelect.add(option);
        });
      }
    }
  </script>
</head>

<body class="hold-transition login-page">
  <div class="register-box">
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
              <input type="text" name="firstname" class="form-control ">
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
              <label for="attained">Highest Level Attained at SFAC</label>
              <select required class="form-control select2" id="attained" name="attained" onchange="showOptions()">
                <option disabled selected>Highest Level Attained at SFAC</option>
                <?php
                $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained");
                while ($row1 = mysqli_fetch_array($select_attained)) {
                ?>
                  <option value="<?php echo $row1['sort_id']; ?>"><?php echo $row1['attained']; ?></option>
                <?php
                }
                ?>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="select_combined">Strand/Program</label>
              <select required class="form-control select2" id="select_combined" name="combined">
                <option value="" disabled selected>Select Strand/Program</option>

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
              <input type="number" class="form-control" id="contact_no" name="contact_no" placeholder="Contact Number" min="00000000000001"
                max="9999999999999" oninput="if(this.value.length > 13) this.value = this.value.slice(0, 13)">
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
            <div class="row mt-3 float-right">
              <div class="col-auto">
                <a href="../login/login.php" class="btn btn-danger">Log In</a>
                <button type="submit" name="submit" class="btn btn-primary">Register</button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>

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
