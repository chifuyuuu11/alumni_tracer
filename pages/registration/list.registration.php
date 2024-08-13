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
                                if (isset($_GET['search'])) {
                                    $search = mysqli_real_escape_string($conn, $_GET['search']);

                                    $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_registrations.lastname, ', ', tbl_registrations.firstname, ' ', tbl_registrations.middlename) AS fullname FROM tbl_registrations
                    ORDER BY lastname ");
                                    while ($row = mysqli_fetch_array($info)) {
                                        ?>
                                        <a>
                                            <td><?php echo $row['fullname']; ?></td>
                                            <td><?php echo $row['email']; ?></td>
                                            <td><?php echo $row['contact_no']; ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == "Approved") {
                                                    ?>
                                                    <span class="badge bg-success"><?php echo $row['status']; ?></span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="badge bg-warning"><?php echo $row['status']; ?></span>
                                                    <?php   
                                                }
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                if ($row['status'] == "Pending") {
                                                    ?>
                                                    <a href="admit.registration.php?reg_id=<?php echo $row['reg_id']; ?>"
                                                        type=button class="btn btn-primary mx-1">Admit</a>
                                                    <?php
                                                }
                                                ?>

                                                <buttype="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modal-default<?php echo $row['reg_id']; ?>">Delete
                                        </a>
                                        </tr>
                                        <div class="modal fade" id="modal-default<?php echo $row['reg_id']; ?>" tabindex="-1"
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
                                                        <p> Are you sure you want to delete
                                                            <b><?php echo $row['fullname'] ?></b>
                                                            registration?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                            data-dismiss="modal">Cancel</button>
                                                        <a href="usersData/ctrl.delete.registration.php?reg_id=<?php echo $row['reg_id']; ?>"
                                                            type="button" class="btn btn-danger">Delete</a>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
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