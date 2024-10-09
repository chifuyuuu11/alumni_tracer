<?php
require '../../includes/conn.php';
require '../../includes/session.php';

$reg_id = $_GET['reg_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Registration User</title>

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
                            <h1>Register User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item active">Registration User</li>
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
                            <form class="form" enctype="multipart/form-data" method="POST" action="usersData/ctrl.admit.registration.php?reg_id=<?php echo $reg_id?>">
                            <?php
                    $info = mysqli_query($conn, "SELECT * FROM tbl_registrations WHERE reg_id = '$reg_id'");
                    while ($row = mysqli_fetch_array($info)) {
                    ?>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $row['firstname']?>"
                                                placeholder="First Name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="middlename">Middle Name</label>
                                            <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $row['middlename']?>"
                                                placeholder="Middle Name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $row['lastname']?>"
                                                placeholder="Last Name" required>
                                        </div>
                                    </div>

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
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']?>"
                                                placeholder="Enter email" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="contact_no">Contact Number</label>
                                            <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $row['contact_no']?>"
                                                placeholder="Contact Number" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Username" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Password" required autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-primary">Admit</button>
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