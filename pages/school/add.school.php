<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Add School</title>

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
                            <h1>Add School</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Add School</li>
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
                                <h3 class="card-title">Program Chairperson's School</h3>
                            </div>
                            <form class="form" method="POST" action="usersData/ctrl.add.school.php">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="school">School name</label>
                                            <input type="text" class="form-control" id="school" name="school"
                                                placeholder="Enter school" required>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="school">Department</label>
                                            <select required class="form-control select2" id="department"
                                                name="department">
                                                <option class="0" disabled selected>Select department</option>
                                                <?php
                                                $select_department = mysqli_query($conn, "SELECT * FROM tbl_department");
                                                while ($row1 = mysqli_fetch_array($select_department)) {
                                                    ?>
                                                    <option value="<?php echo $row1['dept_id'] ?>">
                                                        <?php echo $row1['department'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="school">Program</label>
                                            <?php
                                            $select_department = mysqli_query($conn, "SELECT * FROM tbl_department WHERE dept_id NOT IN (1, 2, 3)");
                                            while ($row1 = mysqli_fetch_array($select_department)) {
                                                ?>
                                                <hr class="">
                                                <?php echo $row1['department'] ?>
                                                <?php
                                                $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE dept_id = '$row1[dept_id]'");
                                                while ($row = mysqli_fetch_array($select_program)) {
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input <?php echo $row['dept_id']?>" value="<?php echo $row['program_id'] ?>"
                                                            type="checkbox" name="program[]">
                                                        <label
                                                            class="form-check-label"><strong><?php echo $row['program_abv'] ?></strong>  <small class="font-italic">(<?php echo $row['program_desc'] ?>)</small></label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                                
                                                <?php
                                            }
                                            ?>

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