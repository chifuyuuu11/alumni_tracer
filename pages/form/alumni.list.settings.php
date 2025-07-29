<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Alumni List</title>

    <!-- Google Font: Source Sans Pro -->
    <?php require '../../includes/link.php'; ?>
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php require '../../includes/navbar.php'; ?>

        <?php require '../../includes/sidebar.php'; ?>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Alumni List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item active">Alumni List</li>
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
                                <h3 class="card-title">Generate Alumni List</h3>
                            </div>
                            <form enctype="multipart/form-data" method="GET" action="alumni.list.php">
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="form-group col-md-6">
                                            <label for="category">Categorize By</label>
                                            <select required class="form-control select2" id="category" name="category">
                                                <option value="" disabled selected>Select Category</option>
                                                <option value="All">All</option>
                                                <option value="attained_id">Attained Level</option>
                                                <option value="program_id">Program</option>
                                                <option value="estatus_id">Employment Status</option>
                                                <option value="alligned">Employment Allignment</option>
                                                <option value="batch">Batch</option>
                                                <option value="campus">Campus</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="sort">Sort By</label>
                                            <select required class="form-control select2" id="sort" name="sort">
                                                <option value="" disabled selected>Select Order</option>
                                                <option value="ASC">Ascending</option>
                                                <option value="DESC">Descending</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="collapse" id="collapseExample">
                                        <hr class="mt-4">
                                        <div class="row justify-content-center  ">
                                            <div class="form-group col-md-4">
                                                <label for="category">Attained</label>
                                                <select required class="form-control select2" id="attained1" name="attained">
                                                    <option value="All" selected>Select All
                                                    </option>
                                                    <?php
                                                    $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained");
                                                    while ($row1 = mysqli_fetch_array($select_attained)) {
                                                        ?>
                                                        <option class="<?php echo $row1['dept_id'] ?>"
                                                            value="<?php echo $row1['attained']; ?>">
                                                            <?php echo $row1['attained']; ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="category">Program</label>
                                                <select required class="form-control select2" id="program"
                                                    name="program">
                                                    <option value="All" class="0" selected>Select All</option>
                                                    <?php
                                                    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs ORDER BY dept_id, program_desc");
                                                    while ($row1 = mysqli_fetch_array($select_program)) {
                                                        ?>
                                                        <option class="<?php echo $row1['dept_id'] ?>"
                                                            value="<?php echo $row1['program_desc'] ?>">
                                                            <?php echo $row1['program_desc'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="category">Campus</label>
                                                <select required class="form-control select2" id="campus"
                                                    name="campus">
                                                    <option value="All" class="0" selected>Select All</option>
                                                    <?php
                                                    $select_campus = mysqli_query($conn, "SELECT * FROM tbl_campus ORDER BY campus");
                                                    while ($row1 = mysqli_fetch_array($select_campus)) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $row1['campus'] ?>">
                                                            <?php echo $row1['campus'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="form-group col-md-4">
                                                <label for="">Batch</label>
                                                <select name="batch" id="batch" class="form-control select2">
                                                        <option value="All" selected>Select All</option>
                                                        <?php
                                                        $select_batch = mysqli_query($conn, "SELECT batch FROM tbl_alumni GROUP BY batch ORDER BY batch ASC");
                                                        while ($row1 = mysqli_fetch_array($select_batch)) {
                                                        ?>
                                                            <option
                                                            value="<?php echo $row1['batch'] ?>">
                                                            Batch <?php echo $row1['batch'] ?>
                                                            </option>
                                                        <?php  
                                                        }
                                                        
                                                        ?>

                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Allignment</label>
                                                <select name="alligned" id="alligned" class="form-control select2">
                                                        <option value="All" selected>Select All
                                                        </option>
                                                        <option value="Yes">Yes</option>
                                                        <option value="No">No</option>
                                                        <option value="Not Applicable">Not Applicable</option>
                                                     

                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Employability Status</label>
                                                <select name="estatus" id="estatus" class="form-control select2">
                                                    <option value="All" selected>Select All
                                                    </option>
                                                    <?php
                                                    $select_estatus = mysqli_query($conn, "SELECT * FROM tbl_employment_status");
                                                    while ($row1 = mysqli_fetch_array($select_estatus)) {
                                                        ?>
                                                        <option value="<?php echo $row1['employment_status'] ?>">
                                                            <?php echo $row1['employment_status'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Generate</button>
                                    <button class="btn btn-primary" type="button" data-toggle="collapse"
                                        data-target="#collapseExample" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Advanced Search
                                    </button>
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