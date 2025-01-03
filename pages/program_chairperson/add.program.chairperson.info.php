<?php
require '../../includes/conn.php';
require '../../includes/session.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Edit Program Chairperson</title>

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
                            <h1>Edit Program Chairperson</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item active">Edit Program Chairperson</li>
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
                                <h3 class="card-title">Program Chairperson Info</h3>
                            </div>
                            <div class="card-body">
                                <form action="usersData/ctrl.edit.program.chairperson.info.php?user_id=<?php echo $user_id; ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <?php
                                    $info = mysqli_query($conn, "SELECT *, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname FROM tbl_program_chairperson
                                    LEFT JOIN tbl_users ON tbl_users.user_id = tbl_program_chairperson.user_id
                                    LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                                    WHERE tbl_program_chairperson.user_id = '$user_id'");
                                    while ($row = mysqli_fetch_array($info)) {
                                        ?>

                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="firstname">Fullname</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname"
                                                    value="<?php echo $row['fullname'] ?>" placeholder="Full Name" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="firstname">Role</label>
                                                <input type="text" class="form-control" id="role" name="role"
                                                    value="<?php echo $row['role'] ?>" placeholder="Role" readonly>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="firstname">School</label>
                                                <select required class="form-control select2" id="school" name="school">
                                                    <?php
                                                    $select_school = mysqli_query($conn, "SELECT * FROM tbl_schools WHERE school_id = '$row[school_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_school)) {
                                                        ?>
                                                        <option value="<?php echo $row1['school_id'] ?>">
                                                            <?php echo $row1['school'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $select_school = mysqli_query($conn, "SELECT * FROM tbl_schools WHERE NOT school_id = '$row[school_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_school)) {
                                                        ?>
                                                        <option value="<?php echo $row1['school_id'] ?>">
                                                            <?php echo $row1['school'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
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
        </div>
        <!-- /.card-footer-->
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