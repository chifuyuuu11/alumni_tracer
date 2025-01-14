<?php
require '../../includes/session.php';
require '../../includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="icon" type="image/x-icon" href="../../dist/img/sfac.png">
  <!-- Google Font: Source Sans Pro -->
  <?php require '../../includes/link.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../docs/assets/img/SFAC-Logo.jpg" alt="AdminLTELogo" height="100"
        width="100">
    </div>

    <!-- Navbar -->
    <?php require '../../includes/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Sidebar -->
    <?php require '../../includes/sidebar.php'; ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <?php if ($_SESSION['user_role'] == "Super Admin" || $_SESSION['user_role'] == "Admin" || $_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head"|| $_SESSION['user_role'] == "Dean") { ?>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">

                <div class="bg-info  shadow-sm card">
                  <div class="row p-3 justify-content-center">

                    <div class="col-md-2 my-auto text-center">
                      <a class="text-light " href="list.alumni.php">
                        <?php
                        if ($_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head"|| $_SESSION['user_role'] == "Dean") {
                          $select_info = mysqli_query($conn, "SELECT program_id FROM tbl_program_chairperson
                          LEFT JOIN tbl_schools ON tbl_schools.school_id = tbl_program_chairperson.school_id
                          WHERE user_id = '$_SESSION[user_id]'");
                          $row2 = mysqli_fetch_array($select_info);

                          $program = explode(', ' , $row2['program_id']);
                          $program = join("', '", $program);

                          $select_alumni = mysqli_query($conn, "SELECT user_id FROM tbl_alumni LEFT JOIN tbl_programs
                          ON tbl_programs.program_id = tbl_alumni.program_id WHERE NOT tbl_alumni.program_id = '' AND tbl_alumni.program_id IN ('$program')");

                        } else {
                          $select_alumni = mysqli_query($conn, "SELECT user_id FROM tbl_alumni");
                          
                        }
                        $count = mysqli_num_rows($select_alumni);
                        ?>
                        <h1 class="my-n2 display-3 font-weight-bold"><?php echo $count; ?></h1>

                      </div>
                      <div class="col-md-8 my-auto text-center">
                        <div class=" justify-content-center row">
                          <?php
                          if ($_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head"|| $_SESSION['user_role'] == "Dean") {
                            $select_alumni = mysqli_query($conn, "SELECT COUNT(program_abv) as alumni_count, program_abv as title FROM tbl_alumni LEFT JOIN tbl_programs
                            ON tbl_programs.program_id = tbl_alumni.program_id WHERE NOT tbl_alumni.program_id = '' AND tbl_alumni.program_id IN ('$program') GROUP BY tbl_alumni.program_id");
                            
                          } else {
                            $select_alumni = mysqli_query($conn, "SELECT COUNT(attained) as alumni_count, attained as title FROM tbl_alumni LEFT JOIN tbl_attained
                            ON tbl_attained.attained_id = tbl_alumni.attained_id WHERE NOT tbl_alumni.attained_id = '' GROUP BY tbl_alumni.attained_id");
                          }
                          
                          while ($row = mysqli_fetch_array($select_alumni)) {
                            ?>
                            <div class="col-4 col-sm">
                              <h4 class="font-weight-bold"><?php echo $row['alumni_count']; ?></h4>
                              <p><?php echo $row['title']; ?></p>
                            </div>
                            <?php
                          }
                          ?>
                        </div>
                        <hr>
                        <div class=" justify-content-center row">
                          <?php
                          if ($_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head"|| $_SESSION['user_role'] == "Dean") {
                            $select_alumni = mysqli_query($conn, "SELECT COUNT(tbl_users.campus_id) as count, campus FROM tbl_users
                            LEFT JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
                            LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                            WHERE role_id = 1 AND tbl_users.campus_id NOT IN (0) AND program_id IN ('$program') GROUP BY tbl_users.campus_id");
                          } else {
                            $select_alumni = mysqli_query($conn, "SELECT COUNT(tbl_users.campus_id) as count, campus FROM tbl_users
                            LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                            WHERE role_id = 1 AND tbl_users.campus_id NOT IN (0) GROUP BY tbl_users.campus_id");
                          }
                          
                          while ($row = mysqli_fetch_array($select_alumni)) {
                            ?>
                            <div class="col-4 col-sm">
                              <h4 class="font-weight-bold"><?php echo $row['count']; ?></h4>
                              <p><?php echo $row['campus']; ?></p>
                            </div>
                            <?php
                          }
                          ?>
                        </div>
                      </div>
                      <div class="col-md-2 my-auto text-center text-warning">
                        <h1 class="my-n2 display-3 font-weight-bold">0.0</h1>
                        <p>Average satisfaction score</p>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo ($_SESSION['user_role'] == "Super Admin" || $_SESSION['user_role'] == "Admin") ? "../users/list.users.php" : "#"; ?>"
                  class="text-dark">
                  <div class="info-box alumni">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                      <?php
                      $select_users = mysqli_query($conn, "SELECT * FROM tbl_users");
                      $count = mysqli_num_rows($select_users);
                      ?>
                      <span class="info-box-text">Users</span>
                      <span class="info-box-number">
                        <?php echo $count; ?>
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </a>
              </div>

              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box alumni mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-handshake"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Linkages</span>
                    <span class="info-box-number">0</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box alumni mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Community Extension</span>
                    <span class="info-box-number">0</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->

              <div class="col-12 col-sm-6 col-md-3">
                <a href="<?php echo ($_SESSION['user_role'] == "Super Admin" || $_SESSION['user_role'] == "Admin") ? "../registration/list.registration.php" : "#"; ?>"
                  class="text-dark">
                  <div class="info-box mb-3 alumni">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-globe"></i></span>

                    <div class="info-box-content">
                      <?php
                      $select_reg = mysqli_query($conn, "SELECT * FROM tbl_registrations WHERE status = 'Pending'");
                      $result = mysqli_num_rows($select_reg);
                      ?>
                      <span class="info-box-text">Online Registrations</span>
                      <span class="info-box-number"><?php echo $result; ?></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </a>
              </div>

              <!-- /.col -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </section>
        <?php
      } elseif ($_SESSION['user_role'] == "Alumni") {
        ?>
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box alumni mb-3">
                  <span class="info-box-icon bg-info elevation-1"><i class="fas fa-handshake"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Linkages</span>
                    <span class="info-box-number">0</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
              <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box alumni mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-hand-holding-heart"></i></span>

                  <div class="info-box-content">
                    <span class="info-box-text">Community Extension</span>
                    <span class="info-box-number">0</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
              </div>
              <!-- /.col -->
            </div>
          </div>
        </section>
        <?php
      }
      ?>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require '../../includes/footer.php'; ?>
  <!-- ./wrapper -->
  <!-- jQuery -->
  <?php require '../../includes/script.php'; ?>
</body>

</html>