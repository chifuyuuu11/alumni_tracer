<?php
require '../../includes/conn.php';
require '../../includes/session.php';

$user_id = $_GET['user_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Edit User</title>

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
                            <h1>Edit User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">User Info</h3>
                    </div>
                    <form action="usersData/ctrl.edit.users.php?user_id=<?php echo $user_id;?>" method="POST" enctype="multipart/form-data">
                    <?php
                    $info = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$user_id'");
                    while ($row = mysqli_fetch_array($info)) {
                    ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']?>" placeholder="First Name" required>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $row['middlename']?>" placeholder="Middle Name" >
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']?>" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="role">Role</label>
                                    <select required class="form-control select2" id="role" name="role">
                                    <?php
                                    $select_role = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE role_id = '$row[role_id]'");
                                    while($row1 = mysqli_fetch_array($select_role)) {
                                    ?>
                                    <option value="<?php echo $row1['role_id']?>"><?php echo $row1['role']?></option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $select_role = mysqli_query($conn, "SELECT * FROM tbl_roles WHERE NOT role_id = '$row[role_id]'");
                                    while($row1 = mysqli_fetch_array($select_role)) {
                                    ?>
                                    <option value="<?php echo $row1['role_id']?>"><?php echo $row1['role']?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="campus">Campus</label>
                                    <select required class="form-control select2" id="campus" name="campus">
                                    <?php
                                    $select_campus = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus_id = '$row[campus_id]'");
                                    while($row1 = mysqli_fetch_array($select_campus)) {
                                    ?>
                                    <option value="<?php echo $row1['campus_id']?>"><?php echo $row1['campus']?></option>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    $select_campus = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE NOT campus_id = '$row[campus_id]'");
                                    while($row1 = mysqli_fetch_array($select_campus)) {
                                    ?>
                                    <option value="<?php echo $row1['campus_id']?>"><?php echo $row1['campus']?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']?>" placeholder="Enter email" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contact">Contact Number</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']?>" placeholder="Contact Number" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']?>" placeholder="Username" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <?php
                        }
                        ?>
                    </form>
                </div>
                </div>
                </div>
                <!-- /.card-footer-->
        </div>
        <!-- /.card -->
        </section>
        <!-- /.content -->
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