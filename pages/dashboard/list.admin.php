<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Admin List</title>

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
                            <h1>Admin List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Admin List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Admin List and Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form method="GET">
                        <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="firstname" name="search"
                                        placeholder="Search first name, last name, ...">
                                </div>
                                <div class="form-group-append">
                                    <span class="form-group-text"><button class="btn btn-primary">Search</button></span>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Fullname</th>
                                    <th>Role</th>
                                    <th>Campus</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_GET['search']);

                                    $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                                    LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id 
                                    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                                    WHERE (lastname LIKE '%$search%' OR firstname LIKE '%$search%' OR middlename LIKE '%$search%' OR role LIKE '%$search%' OR campus LIKE '%$search%') AND tbl_roles.role_id=4 ORDER BY lastname");
                                    while ($row = mysqli_fetch_array($info)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php
                                                if (!empty(base64_encode($row['img']))) {
                                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img zoom " alt="User image" style="height: 80px; width: 100px">';
                                                } else {
                                                    echo ' <img src="../../docs/assets/img/user.png" class="img zoom" alt="User image"  style="height: 80px; width: 100px">';
                                                } ?>
                                            </td>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['role']; ?></td>
                                            <td><?php echo $row['campus']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['contact']; ?></td>
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