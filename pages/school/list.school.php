<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | School List</title>

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
    
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>School List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item active">School List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">School List and Settings</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>School</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $info = mysqli_query($conn, "SELECT * FROM tbl_schools");
                                while ($row = mysqli_fetch_array($info)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['school']; ?><br>
                                            
                                            <?php
                                            $program = explode(', ', $row['program_id']);
                                            foreach ($program as $id) {
                                                $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_id = '$id'");
                                                $row2 = mysqli_fetch_array($select_program);
                                                ?>
                                                <span class="badge badge-info"><?php echo $row2['program_abv'];?></span>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td><a href="edit.school.php?school_id=<?php echo $row['school_id']; ?>" type="button"
                                                class="btn btn-primary btn-sm m-1">Update</a>
                                            <button type="button" class="btn btn-danger btn-sm m-1" data-toggle="modal"
                                                data-target="#modal-default<?php echo $row['school_id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="modal-default<?php echo $row['school_id']; ?>" tabindex="-1"
                                        aria-labelledby="modal-defaultLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal-defaultLabel">Confirm Delete</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> Are you sure you want to delete <b><?php echo $row['school']?></b>?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                                    <a href="usersData/ctrl.delete.school.php?school_id=<?php echo $row['school_id']; ?>"
                                                        type="button" class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
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