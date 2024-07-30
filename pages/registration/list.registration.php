<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Student List</title>

    <!-- Google Font: Source Sans Pro -->
    <?php require '../../includes/link.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php require '../../includes/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Sidebar -->
            <?php require '../../includes/sidebar.php'; ?>
            <!-- /.sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Online Registrations</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Online Registrations</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Online Registrations</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Fullname</th>
           
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Remark</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_registrations.lastname, ', ', tbl_registrations.firstname, ' ', tbl_registrations.middlename) AS fullname FROM tbl_registrations
                  ORDER BY lastname ");
                  while ($row = mysqli_fetch_array($info)) {
                  ?>
                  <tr>
                  <td><?php echo $row['fullname'];?></td>
                  <td><?php echo $row['email'];?></td>
                  <td><?php echo $row['contact_no'];?></td>
                  <td><?php echo $row['status'];?></td>
                  <td><button class="btn btn-primary mx-1">Admit</button> <button class="btn btn-danger mx-1">Delete</button></td>
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