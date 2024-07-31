<?php
  require '../../includes/session.php';
  require '../../includes/conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Alumni Tracer | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <?php require '../../includes/link.php'; ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../docs/assets/img/SFAC-Logo.jpg" alt="AdminLTELogo" height="100" width="100">
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Total Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="list.users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive">
              <div class="inner">
              <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role_id=1");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Alumni</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="list.alumni.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role_id=2");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Admin</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="list.admin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-gray">
              <div class="inner">
                <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role_id=3");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Student</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="list.student.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-lightblue">
              <div class="inner">
                <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role_id=4");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Registrar</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="list.registrar.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
              <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_users WHERE role_id=5");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Super Admin</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="list.superadmin.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
              <?php 
                $select_users = mysqli_query($conn, "SELECT * FROM tbl_registrations");
                $row = mysqli_num_rows($select_users);
                ?>

                <h3><?php echo $row ?></h3>

                <p>Online Registration</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="../registration/list.registration.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require '../../includes/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?php require '../../includes/script.php'; ?>
</body>
</html>
