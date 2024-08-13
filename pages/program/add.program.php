<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Add Program</title>

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
                            <h1>Add Program</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add Program</li>
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
                                <h3 class="card-title">Add Program</h3>
                            </div>
                            <form class="form" method="POST" action="usersData/ctrl.add.program.php">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="program_abv">Program Abbreviation</label>
                                            <input type="text" class="form-control" id="program_abv" name="program_abv"
                                                placeholder="Enter Program Abbreviation" required>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <label for="program_desc">Program Description</label>
                                            <input type="text" class="form-control" id="program_desc"
                                                name="program_desc" placeholder="Enter Program Descrition" required>
                                        </div>
                                        <div class="form-group col-md-10">
                                            <label for="department">Program Department</label>
                                            <select required class="form-control select2" id="department"
                                                name="department">
                                                <option value="" disabled selected>Select Program Department</option>
                                                <?php
                                                $select_department = mysqli_query($conn, "SELECT * FROM tbl_department");
                                                while ($row = mysqli_fetch_array($select_department)) {
                                                    ?>
                                                    <option value="<?php echo $row['dept_id'] ?>">
                                                        <?php echo $row['department'] ?>
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