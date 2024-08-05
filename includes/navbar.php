<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-danger text-white">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="../dashboard/index.php" class="nav-link text-white">Home</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
      <?php
            $info = mysqli_query($conn, "SELECT * FROM tbl_users WHERE user_id = '$_SESSION[user_id]'");
            $row = mysqli_fetch_array($info);
            if (!empty($row['img'])) {
              ?>
              <img style="width: 30px; height: 30px;"
                src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <?php
            } else {
              ?>
              <img style="width: 30px; height: 30px;" src="../../docs/assets/img/user.png" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <?php
            }
            ?>
        <span class="badge badge-warning navbar-badge"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <div class="dropdown-item">
          <div class="media">
            <?php

            if (!empty($row['img'])) {
              ?>
              <img style="width: 50px; height: 50px;"
                src="data:image/jpeg;base64,<?php echo base64_encode($row['img']) ?>" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <?php
            } else {
              ?>
              <img style="width: 50px; height: 50px;" src="../../docs/assets/img/user.png" alt="User Avatar"
                class="img-size-50 img-circle mr-3">
              <?php
            }
            ?>
            <div class="media-body">
              <h3 class="dropdown-item-title">
                <b>
                  <?php echo $_SESSION['fullname']; ?>
                </b>
                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
              </h3>
              <p class="text-sm"><?php echo $row['email'] ?></p>
              <p class="text-sm text-muted"><i class="far fa-user mr-1"></i><?php echo $row['username'] ?></p>
            </div>
          </div>
        </div>
        <div class="dropdown-divider"></div>
        <a href="../users/edit.users.php" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Edit Account
        </a>
        <div class="dropdown-divider"></div>
        <a href="../login/usersData/ctrl.logout.php" class="dropdown-item dropdown-footer"><b>Log Out</b></a>
      </div>
    </li>
  </ul>
</nav>