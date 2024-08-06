<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Staff List</title>

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
                            <h1>Staff List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Staff List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Staff List and Info</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form method="GET">
                    <div class="row justify-content-center">
                        <div class="form-group col-4">
                            <label>Search</label>
                            <input type="text" class="form-control" id="firstname" name="search"
                            placeholder="Search first name, last name, ...">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-primary mt-4">Search</button>
                        </div>
                    </div>
                </form>
              </div>

              <div class="car-body">
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
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);

                    $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                    LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id WHERE (lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR middlename LIKE '%$search%' OR role LIKE '%$search%' OR campus LIKE '%$search%') AND tbl_roles.role_id=5");
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