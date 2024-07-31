<?php
require '../../includes/conn.php';
require '../../includes/session.php';

$civil_id = $_GET['civil_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Edit Civil Status</title>

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
                            <h1>Edit Civil Status</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit Civil Status</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="row justify-content-center">
                <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Civil Status</h3>
                    </div>
                    <form class="form" action="usersData/ctrl.edit.civil.stat.php?civil_id=<?php echo $civil_id;?>" method="POST" >
                    <?php
                    $info = mysqli_query($conn, "SELECT * FROM tbl_cvlstat WHERE civil_id = '$civil_id'");
                    while ($row = mysqli_fetch_array($info)) {
                    ?>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-10">
                                    <label for="campus">Edit Civil Status</label>
                                    <input type="text" class="form-control" id="civil" name="civil" value="<?php echo $row['civilstat']?>" placeholder="Enter Civil Status" required>
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