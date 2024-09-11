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
    <title>Alumni Tracer | Edit User</title>

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
                            <h1>Edit User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
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
                                <h3 class="card-title">Alumni Info</h3>
                            </div>
                            <div class="card-body">
                                <form action="usersData/ctrl.edit.alumni.php?user_id=<?php echo $user_id; ?>"
                                    method="POST" enctype="multipart/form-data">
                                    <?php
                                    $info = mysqli_query($conn, "SELECT *, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname FROM tbl_alumni
                                    LEFT JOIN tbl_users ON tbl_users.user_id = tbl_alumni.user_id
                                    LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                                    WHERE tbl_alumni.user_id = '$user_id'");
                                    while ($row = mysqli_fetch_array($info)) {
                                        ?>

                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="firstname">Fullname</label>
                                                <input type="text" class="form-control" id="fullname" name="fullname"
                                                    value="<?php echo $row['fullname'] ?>" placeholder="Full Name" readonly
                                                    >
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="firstname">Role</label>
                                                <input type="text" class="form-control" id="role" name="role"
                                                    value="<?php echo $row['role'] ?>" placeholder="Role" readonly
                                                    >
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label for="firstname">Highest Level Attained at SFAC</label>
                                                <select required class="form-control select2" id="attained" name="attained">
                                                    <?php
                                                    $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained_id = '$row[attained_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_attained)) {
                                                        ?>
                                                        <option value="<?php echo $row1['attained_id'] ?>"><?php echo $row1['attained'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE NOT attained_id = '$row[attained_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_attained)) {
                                                        ?>
                                                        <option value="<?php echo $row1['attained_id'] ?>"><?php echo $row1['attained'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="firstname">Program</label>
                                                <select required class="form-control select2" id="program" name="program">
                                                    <?php
                                                    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE program_id = '$row[program_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_program)) {
                                                        ?>
                                                        <option value="<?php echo $row1['program_id'] ?>"><?php echo $row1['program_desc'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs WHERE NOT program_id = '$row[program_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_program)) {
                                                        ?>
                                                        <option value="<?php echo $row1['program_id'] ?>"><?php echo $row1['program_desc'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="firstname">Batch</label>
                                                <input type="text" class="form-control" id="batch" name="batch"
                                                    value="<?php echo $row['batch'] ?>" placeholder="Batch" 
                                                    >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="firstname">After graduating or leaving SFAC, which of the following scenarios did you do?</label>
                                                <select required class="form-control select2" id="aftergrad" name="aftergrad">
                                                    <?php
                                                    $select_aftergrad = mysqli_query($conn, "SELECT * FROM tbl_aftergrad WHERE aftergrad_id = '$row[aftergrad_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_aftergrad)) {
                                                        ?>
                                                        <option value="<?php echo $row1['aftergrad_id'] ?>"><?php echo $row1['aftergrad'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $select_aftergrad = mysqli_query($conn, "SELECT * FROM tbl_aftergrad WHERE NOT aftergrad_id = '$row[aftergrad_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_aftergrad)) {
                                                        ?>
                                                        <option value="<?php echo $row1['aftergrad_id'] ?>"><?php echo $row1['aftergrad'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>         
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-md-8">
                                                <label for="firstname">Nature of Work</label>
                                                <select required class="form-control select2" id="work" name="work">
                                                    <?php
                                                    $select_work = mysqli_query($conn, "SELECT * FROM tbl_work WHERE work_id = '$row[work_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_work)) {
                                                        ?>
                                                        <option value="<?php echo $row1['work_id'] ?>"><?php echo $row1['work'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    $select_work = mysqli_query($conn, "SELECT * FROM tbl_work WHERE NOT work_id = '$row[work_id]'");
                                                    while ($row1 = mysqli_fetch_array($select_work)) {
                                                        ?>
                                                        <option value="<?php echo $row1['work_id'] ?>"><?php echo $row1['work'] ?>
                                                        </option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>  
                                            <div class="form-group col-md-4">
                                                <label for="current_work">Current Work</label>
                                                <input type="text" class="form-control" id="current_work" name="current_work"
                                                    value="<?php echo $row['current_work'] ?>" placeholder="Current Work" 
                                                    >
                                            </div>        
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="company_name">Name of Company</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name"
                                                    value="<?php echo $row['company_name'] ?>" placeholder="Company Name" 
                                                    >
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="company_address">Address of Company</label>
                                                <input type="text" class="form-control" id="company_address" name="company_address"
                                                    value="<?php echo $row['company_address'] ?>" placeholder="Company Address" 
                                                    >
                                            </div>    
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="scale">From 1-10 (1 is the lowest and 10 is the highest) rate your level of satisfaction during your stay at SFAC:</label>
                                                <input type="number" class="form-control" id="scale" name="scale" min="1" max="10"
                                                value="<?php echo $row['scale'] ?>" placeholder="1 to 10">   
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="experience">Briefly describe your unforgettable moments at SFAC/SAS.</label>
                                                <input type="text" class="form-control" id="experience" name="experience"
                                                value="<?php echo $row['experience'] ?>" placeholder="When I was at SFAC/SAS ...">  
                                            </div>    
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="suggestion">What do you want SFAC to improve? Please give us your suggestions.</label>
                                                <input type="text" class="form-control" id="suggestion" name="suggestion"
                                                value="<?php echo $row['suggestion'] ?>" placeholder="My suggestions for SFAC/SAS ...">  
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