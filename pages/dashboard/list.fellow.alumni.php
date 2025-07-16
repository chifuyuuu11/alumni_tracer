<?php
require '../../includes/conn.php';
require '../../includes/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alumni Tracer | Fellow Alumni List</title>

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
                            <h1>Fellow Alumni List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="../dashboard/index.php">Home</a></li>
                                <li class="breadcrumb-item active">Fellow Alumni List</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Fellow Alumni List and Info</h3>
                    </div>


                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Fullname</th>
                                    <th>Program</th>
                                    <th>Campus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $user_info = mysqli_query($conn, "SELECT * FROM tbl_alumni WHERE user_id = '$_SESSION[user_id]'");
                                $row = mysqli_fetch_array($user_info);

                                $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                    JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
                    LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
                    LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
                    LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                    LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                    WHERE tbl_users.role_id = 1 AND batch = '$row[batch]' AND tbl_alumni.attained_id = '$row[attained_id]' ORDER BY lastname");

                                while ($row = mysqli_fetch_array($info)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            if (!empty(base64_encode($row['img']))) {
                                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['img']) . '" class="img zoom " alt="User image" style="height: 80px; width: 100px">';
                                            } else {
                                                echo ' <img src="../../docs/assets/img/user.png" class="img zoom" alt="User image"  style="height: 80px; width: 100px">';
                                            } ?>
                                        </td>
                                        <td><?php echo ucwords(strtolower($row['fullname'])); ?></td>
                                        <td><?php echo $row['attained'] . '<br>' . $row['program_desc']; ?></td>
                                        <td><?php echo $row['campus'] . '<br>' . $row['batch']; ?></td>
                                    </tr>
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