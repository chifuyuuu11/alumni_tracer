<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-danger elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link bg-danger">
    <img src="../../docs/assets/img/SFAC-Logo.jpg" alt="SFAC Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
    <span class="brand-text font-weight-light">Alumni Tracer</span>
  </a>
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <?php
        $info = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]'");
        $row = mysqli_fetch_array($info);
        if (!empty($row['img'])) {
          ?>
          <img style="width: 40px; height: 40px;" src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>"
            class="img-circle elevation-2 mt-2" alt="User Image">
          <?php
        } else {
          ?>
          <img style="width: 40px; height: 40px;" src="../../docs/assets/img/user.png" class="img-circle elevation-2 mt-2"
            alt="User Image">
          <?php
        }
        ?>
      </div>
      <div class="info">
        <a class="d-block"><?php echo $_SESSION['fullname']; ?></a>
        <a class="d-block text-break"><b><?php echo $_SESSION['user_role']; ?></b></a>
        <small class="d-block" style="color:#c2c7d0">
          <b>
            <?php
            if ($_SESSION['user_role'] == "Alumni") {
              $select_alumni = mysqli_query($conn, "SELECT * FROM tbl_alumni WHERE user_id = '$_SESSION[user_id]'");
              $row = mysqli_fetch_array($select_alumni);

              echo "Batch " . $row['batch'];

            } elseif ($_SESSION['user_role'] == "Program Chairperson" || $_SESSION['user_role'] == "Academic Head"|| $_SESSION['user_role'] == "Dean") {
              $select_pc = mysqli_query($conn, "SELECT * FROM tbl_program_chairperson
              LEFT JOIN tbl_schools ON tbl_schools.school_id = tbl_program_chairperson.school_id
              WHERE user_id = '$_SESSION[user_id]'");
              $row = mysqli_fetch_array($select_pc);

              echo $row['school_abv'];
            }
            
            ?>
          </b>
        </small>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="../dashboard/index.php" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php
        if ($_SESSION['user_role'] == "Super Admin") {
          ?>
          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../users/add.users.php" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../users/list.users.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>
                    After Graduation
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../aftergrad/add.after.grad.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add After Graduation</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../aftergrad/list.after.grad.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>After Graduation List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>
                    Campus
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../campus/add.campus.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Campus</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../campus/list.campus.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Campus List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>
                    School
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../school/add.school.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add School</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../school/list.school.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>School List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-star-half-alt nav-icon"></i>
                  <p>
                    Civil Status
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../civil/add.civil.stat.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Civil Status</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../civil/list.civil.stat.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Civil Status List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-university nav-icon"></i>
                  <p>
                    Department
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../department/add.department.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Department</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../department/list.department.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Department List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>
                    Program
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../program/add.program.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Program</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../program/list.program.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Program List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-tag nav-icon"></i>
                  <p>
                    Role
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../role/add.roles.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Role</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../role/list.roles.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Role List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-md nav-icon"></i>
                  <p>
                    Work
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../work/add.work.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Work</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../work/list.work.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Work List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-layer-group nav-icon"></i>
                  <p>
                    Year Level
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../level/add.level.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Year Level</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../level/list.level.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Year Level List</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-header">FPDF</li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Forms List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../form/alumni.list.settings.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Alumni List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../form/student.list.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <?php
        } else if ($_SESSION['user_role'] == "Admin") {
          ?>
          <!-- <li class="nav-header">EXAMPLES</li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../users/add.users.php" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../users/list.users.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>
                    After Graduation
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../aftergrad/add.after.grad.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add After Graduation</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../aftergrad/list.after.grad.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>After Graduation List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-school nav-icon"></i>
                  <p>
                    Campus
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../campus/add.campus.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Campus</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../campus/list.campus.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Campus List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-star-half-alt nav-icon"></i>
                  <p>
                    Civil Status
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../civil/add.civil.stat.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Civil Status</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../civil/list.civil.stat.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Civil Status List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-university nav-icon"></i>
                  <p>
                    Department
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../department/add.department.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Department</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../department/list.department.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Department List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>
                    Program
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../program/add.program.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Program</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../program/list.program.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Program List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-tag nav-icon"></i>
                  <p>
                    Role
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../role/add.roles.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Role</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../role/list.roles.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Role List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-user-md nav-icon"></i>
                  <p>
                    Work
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../work/add.work.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Work</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../work/list.work.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Work List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-layer-group nav-icon"></i>
                  <p>
                    Year Level
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../level/add.level.php" class="nav-link">
                      <i class="fas fa-plus-circle nav-icon"></i>
                      <p>Add Year Level</p>
                    </a>
                  </li>
                </ul>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../level/list.level.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Year Level List</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <!-- <li class="nav-header">FPDF</li> -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Forms List
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../form/alumni.list.settings.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Alumni List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../form/student.list.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
            </ul>
          </li>
          </ul>
        <?php
        } else if ($_SESSION['user_role'] == "Registrar") {
          ?>
            <!-- <li class="nav-header">EXAMPLES</li> -->
            <li class="nav-item">

              <a href="../users/edit.users.php" class="nav-link">
                <i class="fas fa-user mr-3"></i>

                Update Info

              </a>


            </li>

            <li class="nav-item">
              <a href="../users/list.users.php" class="nav-link">
                <i class="fas fa-list nav-icon"></i>
                <p>Users List</p>
              </a>
            </li>

        <?php
        } else if ($_SESSION['user_role'] == "Admin") {
          ?>
              <!-- <li class="nav-header">EXAMPLES</li> -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Users
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../users/add.users.php" class="nav-link">
                      <i class="fas fa-user-plus nav-icon"></i>
                      <p>Add User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../users/list.users.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Users List</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cogs"></i>
                  <p>
                    Settings
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user-tie nav-icon"></i>
                      <p>
                        After Graduation
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../aftergrad/add.after.grad.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add After Graduation</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../aftergrad/list.after.grad.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>After Graduation List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-school nav-icon"></i>
                      <p>
                        Campus
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../campus/add.campus.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Campus</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../campus/list.campus.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Campus List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-university nav-icon"></i>
                      <p>
                        Department
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../department/add.department.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Department</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../department/list.department.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Department List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-star-half-alt nav-icon"></i>
                      <p>
                        Civil Status
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../civil/add.civil.stat.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Civil Status</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../civil/list.civil.stat.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Civil Status List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user-friends nav-icon"></i>
                      <p>
                        Program
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../program/add.program.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Program</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../program/list.program.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Program List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user-tag nav-icon"></i>
                      <p>
                        Role
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../role/add.roles.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Role</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../role/list.roles.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Role List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-user-md nav-icon"></i>
                      <p>
                        Work
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../work/add.work.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Work</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../work/list.work.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Work List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="fas fa-layer-group nav-icon"></i>
                      <p>
                        Year Level
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../level/add.level.php" class="nav-link">
                          <i class="fas fa-plus-circle nav-icon"></i>
                          <p>Add Year Level</p>
                        </a>
                      </li>
                    </ul>
                    <ul class="nav nav-treeview">
                      <li class="nav-item">
                        <a href="../level/list.level.php" class="nav-link">
                          <i class="fas fa-list nav-icon"></i>
                          <p>Year Level List</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <!-- <li class="nav-header">FPDF</li> -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-file"></i>
                  <p>
                    Forms List
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../form/alumni.list.settings.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Alumni List</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../form/student.list.php" class="nav-link">
                      <i class="fas fa-list nav-icon"></i>
                      <p>Student List</p>
                    </a>
                  </li>
                </ul>
              </li>
              </ul>
        <?php
        } else if ($_SESSION['user_role'] == "Alumni") {
          ?>
                <!-- <li class="nav-header">EXAMPLES</li> -->
                <li class="nav-item">

                  <a href="../users/edit.users.php" class="nav-link">
                    <i class="fas fa-pen mr-3"></i>

                    Update Personal Info:

                  </a>


                </li>
                <li class="nav-item">
                  <a href="../alumni/add.alumni.info.php?user_id=<?php echo $row['user_id'] ?>" class="nav-link">
                    <i class="fas fa-user mr-3"></i>

                    Update Graduate Info:

                  </a>
                </li>

        <?php
        } else if ($_SESSION['user_role'] == "Student") {
          ?>
        <?php
        } else {

        }
        ?>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
</aside>