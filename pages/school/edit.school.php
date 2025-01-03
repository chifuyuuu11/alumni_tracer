<?php
require '../../includes/conn.php';
require '../../includes/session.php';

$school_id = $_GET['school_id'];    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Edit School</title>

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
                            <h1>Edit School</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Edit School</li>
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
                            <form class="form" method="POST" action="usersData/ctrl.edit.school.php?school_id=<?php echo $school_id; ?>">
                                <?php
                                $select_school = mysqli_query($conn, "SELECT * FROM tbl_schools WHERE school_id = '$school_id'");
                                $row = mysqli_fetch_array($select_school);
                                $program = explode(',', $row['program_id']);
                                ?>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="school">School name</label>
                                            <input type="text" class="form-control" id="school" name="school" value="<?php echo $row['school'];?>"
                                                placeholder="Enter school" required>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-10">
                                            <label for="school">Department</label>
                                            <select required class="form-control select2" id="department"
                                                name="department">
                                                <?php
                                                $select_department = mysqli_query($conn, "SELECT * FROM tbl_department WHERE dept_id = '$row[dept_id]'");
                                                while ($row1 = mysqli_fetch_array($select_department)) {
                                                    ?>
                                                    <option selected value="<?php echo $row1['dept_id'] ?>">
                                                        <?php echo $row1['department'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                $select_department = mysqli_query($conn, "SELECT * FROM tbl_department WHERE NOT dept_id = '$row[dept_id]'");
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
                                                while ($row2 = mysqli_fetch_array($select_program)) {
                                                    if (in_array($row2['program_id'], $program)) {
                                                        $checked = "checked";
                                                    } else {
                                                        $checked = "";
                                                    }
                                                ?>
                                                    <div class="form-check">
                                                        <input class="form-check-input <?php echo $row2['dept_id']?>" value="<?php echo $row2['program_id'] ?>" <?php echo $checked ;?>
                                                            type="checkbox" name="program[]">
                                                        <label
                                                            class="form-check-label"><strong><?php echo $row2['program_abv'] ?></strong>  <small class="font-italic">(<?php echo $row2['program_desc'] ?>)</small></label>
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