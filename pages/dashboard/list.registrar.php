<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registrar List</title>

    <!-- Google Font: Source Sans Pro -->
    <?php require '../../includes/link.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php require '../../includes/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="../../index3.html" class="brand-link">
                <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <?php require '../../includes/sidebar.php'; ?>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Registrar List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Registrar List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registrar List and Info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Fullname</th>
                    <th>Role</th>
                    <th>Campus</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                  LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                  LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id WHERE tbl_roles.role_id=4 ORDER BY lastname");
                  while ($row = mysqli_fetch_array($info)) {
                  ?>
                  <tr>
                  <td><?php echo $row['fullname'];?></td>
                  <td><?php echo $row['role'];?></td>
                  <td><?php echo $row['campus'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['contact'];?></td>
                  <td>Update</td>
                  </tr>
                  <?php
                  }
                  ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
        </div>
        <!-- /.card -->

        </section>
        <!-- /.content -->
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