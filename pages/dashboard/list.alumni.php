<?php
require '../../includes/conn.php';
require '../../includes/session.php';

if (isset($_GET['attained'])) {
    $_SESSION['attained_fltr'] = mysqli_escape_string($conn, $_GET['attained']);
} else {
    $_SESSION['attained_fltr'] = "All";
}

if (isset($_GET['program'])) {
    $_SESSION['program_fltr'] = mysqli_escape_string($conn, $_GET['program']);
} else {
    $_SESSION['program_fltr'] = "All";
}

if (isset($_GET['campus'])) {
    $_SESSION['campus_fltr'] = mysqli_escape_string($conn, $_GET['campus']);
} else {
    $_SESSION['campus_fltr'] = "All";
}

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

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Alumni List and Info</h3><br>
                        <p>Attained Level: <b><?php echo $_SESSION['attained_fltr']; ?></b> Program: <b><?php echo $_SESSION['program_fltr']; ?></b> Campus: <b><?php echo $_SESSION['campus_fltr']; ?></b></p>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row justify-content-center">
                        </div>
                        <form method="GET">
                            <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <input type="text" class="form-control" id="firstname" name="search"
                                        placeholder="Search first name, last name, ...">
                                </div>
                                <div class="form-group-append">
                                    <span class="form-group-text">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </span>
                        </form>
                        <?php
                        if ($_SESSION['user_role'] == "Super Admin" || $_SESSION['user_role'] == "Admin") {
                        ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#confirmModalfilter">
                            Filter
                        </button>
                        <?php
                        }
                        ?>
                        <div class="modal fade" id="confirmModalfilter" tabindex="-1"
                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmModalLabel">Add Filter</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true"></span>
                                        </button>
                                    </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="firstname">Highest Lvl. Attained</label>
                                                    <select required class="form-control select2" id="attained" onchange="programSelect1()"
                                                        name="attained">
                                                        <option value="All">All</option>
                                                        <?php
                                                        $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE attained = '$_SESSION[attained_fltr]'");
                                                        while ($row1 = mysqli_fetch_array($select_attained)) {
                                                            ?>
                                                            <option class="<?php echo $row1['dept_id'] ?>" selected value="<?php echo $row1['attained'] ?>">
                                                                <?php echo $row1['attained'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $select_attained = mysqli_query($conn, "SELECT * FROM tbl_attained WHERE NOT attained = '$_SESSION[attained_fltr]'");
                                                        while ($row1 = mysqli_fetch_array($select_attained)) {
                                                            ?>
                                                            <option class="<?php echo $row1['dept_id'] ?>" value="<?php echo $row1['attained'] ?>">
                                                                <?php echo $row1['attained'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="firstname">Program</label>
                                                    <select required class="form-control select2" id="program"
                                                        name="program">
                                                        <option selected value="<?php echo $_SESSION['program_fltr']?>"><?php echo $_SESSION['program_fltr']?></option>
                                                        <option value="All">All</option>
                                                        <?php
                                                        $select_program = mysqli_query($conn, "SELECT * FROM tbl_programs
                                                                LEFT JOIN tbl_department ON tbl_department.dept_id = tbl_programs.dept_id
                                                                LEFT JOIN tbl_attained ON tbl_attained.dept_id = tbl_department.dept_id
                                                                WHERE program_desc NOT IN ('$_SESSION[program_fltr]') AND attained = '$_SESSION[attained_fltr]'  ORDER BY program_desc ASC");
                                                        while ($row1 = mysqli_fetch_array($select_program)) {
                                                            ?>
                                                            <option class="<?php echo $row1['dept_id'] ?>" value="<?php echo $row1['program_desc'] ?>">
                                                                <?php echo $row1['program_desc'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md">
                                                    <label for="firstname">Campus</label>
                                                    <select required class="form-control select2" id="campus"
                                                        name="campus">
                                                        <option value="All">All</option>
                                                        <?php
                                                        $select_program = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE campus IN ('$_SESSION[campus_fltr]') ORDER BY campus ASC");
                                                        while ($row1 = mysqli_fetch_array($select_program)) {
                                                            ?>
                                                            <option selected value="<?php echo $row1['campus'] ?>">
                                                                <?php echo $row1['campus'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                        <?php
                                                        $select_program = mysqli_query($conn, "SELECT * FROM tbl_campus WHERE NOT campus IN ('$_SESSION[campus_fltr]') ORDER BY campus ASC");
                                                        while ($row1 = mysqli_fetch_array($select_program)) {
                                                            ?>
                                                            <option value="<?php echo $row1['campus'] ?>">
                                                                <?php echo $row1['campus'] ?>
                                                            </option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-info">Send</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="collapse" id="collapseExample">
                    <p class="text-center">Select Grade Level</p>

                </div>
                <!-- <div class="row justify-content-center">
                                <div class="form-group col-4">
                                    <label>Search</label>
                                    <input type="text" class="form-control" id="firstname" name="search"
                                        placeholder="Search first name, last name, ...">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary mt-4">Search</button>
                                </div>
                            </div> -->

        </div>

        <div class="card-body">
            <table id="example1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Fullname</th>
                        <th>Program</th>
                        <th>Campus</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['search'])) {
                        $search = mysqli_real_escape_string($conn, $_GET['search']);

                        if ($_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head" || $_SESSION['user_role'] == "Dean") {
                            $select_info = mysqli_query($conn, "SELECT program_id FROM tbl_program_chairperson
                                        LEFT JOIN tbl_schools ON tbl_schools.school_id = tbl_program_chairperson.school_id
                                        WHERE user_id = '$_SESSION[user_id]'");
                            $row2 = mysqli_fetch_array($select_info);

                            $program = explode(', ', $row2['program_id']);
                            $program = join("', '", $program);

                            $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                                        JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
                                        LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
                                        LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
                                        LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                                        LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                                        WHERE tbl_users.role_id = 1 AND tbl_alumni.program_id IN ('$program') AND (lastname LIKE '%$search%'
                                        OR firstname LIKE '%$search%'
                                        OR middlename LIKE '%$search%'
                                        OR role LIKE '%$search%'
                                        OR campus LIKE '%$search%'
                                        OR program_abv LIKE '%$search%'
                                        OR attained LIKE '%$search%') ORDER BY lastname");

                        } else {
                            //hardcore typa shiii
                            $info = mysqli_query($conn, "SELECT *, CONCAT(tbl_users.lastname, ', ', tbl_users.firstname, ' ', tbl_users.middlename) AS fullname FROM tbl_users
                                        JOIN tbl_alumni ON tbl_alumni.user_id = tbl_users.user_id
                                        LEFT JOIN tbl_attained ON tbl_attained.attained_id = tbl_alumni.attained_id
                                        LEFT JOIN tbl_programs ON tbl_programs.program_id = tbl_alumni.program_id
                                        LEFT JOIN tbl_roles ON tbl_roles.role_id = tbl_users.role_id
                                        LEFT JOIN tbl_campus ON tbl_campus.campus_id = tbl_users.campus_id
                                        WHERE tbl_users.role_id = 1
                                        AND 
                                            CASE WHEN '$_SESSION[attained_fltr]' = 'ALL'
                                            THEN
                                                attained <> ('')
                                            ELSE
                                                attained IN ('$_SESSION[attained_fltr]')
                                            END
                                        AND
                                            CASE
                                            WHEN '$_SESSION[program_fltr]' = 'ALL'
                                                THEN program_desc <> ('') OR tbl_alumni.program_id = 0
                                            ELSE
                                                program_desc IN ('$_SESSION[program_fltr]')
                                            END
                                        AND
                                            CASE
                                            WHEN '$_SESSION[campus_fltr]' = 'ALL'
                                                THEN campus <> ('')
                                            ELSE
                                                campus IN ('$_SESSION[campus_fltr]')
                                            END
                                        AND (lastname LIKE '%$search%'
                                        OR firstname LIKE '%$search%'
                                        OR middlename LIKE '%$search%'
                                        OR role LIKE '%$search%'
                                        OR campus LIKE '%$search%'
                                        OR program_abv LIKE '%$search%'
                                        OR program_desc LIKE '%$search%'
                                        OR attained LIKE '%$search%') ORDER BY lastname");

                        }



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
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                                <td>
                                    <?php
                                    if ($_SESSION['user_role'] == "Admin" || $_SESSION['user_role'] == "Super Admin") {
                                        ?>
                                        <a href="../users/edit.users.php?user_id=<?php echo $row['user_id']; ?>" type="button"
                                            class="btn my-1 btn-info">Update</a>
                                        <?php if (($row['role'] == 'Alumni')) { ?>
                                            <a href="../alumni/add.alumni.info.php?user_id=<?php echo $row['user_id'] ?>"
                                                class="btn my-1 btn-info">Alumni Info</a>
                                            <button type="button" class="btn my-1 btn-primary" disabled data-toggle="modal"
                                                data-target="#confirmModal<?php echo $row['user_id']; ?>">Send
                                                Email</button>
                                        <?php } ?>
                                        <button type="button" class="btn my-1 btn-danger" data-toggle="modal"
                                            data-target="#modal-default<?php echo $row['user_id']; ?>">Delete</a>
                                            <?php
                                    } else {
                                        echo "<b class='font-italic'>You don't have any access avaible</b>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-default<?php echo $row['user_id']; ?>" tabindex="-1"
                                aria-labelledby="modal-defaultLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-defaultLabel">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p> Are you sure you want to delete
                                                <b><?php echo $row['fullname'] ?></b>
                                                account?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <a href="../users/usersData/ctrl.delete.users.php?user_id=<?php echo $row['user_id']; ?>"
                                                type="button" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <div class="modal fade" id="confirmModal<?php echo $row['user_id']; ?>" tabindex="-1"
                                aria-labelledby="confirmModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmModalLabel">Confirm Send</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"></span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to send <b><?php echo $row['email'] ?></b> an
                                                email?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <a href="../email/send.email.php?user_id=<?php echo $row['user_id']; ?>"
                                                type="button" class="btn btn-info">Send</a>
                                        </div>
                                    </div>
                                </div>
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