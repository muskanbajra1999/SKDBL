<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item">
      <img src="images/logo/pngFullLogo2.png" style="width: 245px;">
    </li>
  </ul>

  <ul class="navbar-nav ml-auto">

    <!-- Notifications Dropdown Menu -->

    <li class="nav-item dropdown no-arrow">
      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

        <?php
          $lid=$_SESSION['uid'];
          $query=mysqli_query($con,"select userName from personaldetails where id='$lid'");
          $row=mysqli_fetch_array($query);
          $uname=$row['userName'];
        ?>

        <span class="mr-2 d-none d-lg-inline text-gray-600 small">
          <?php
          echo " ".$uname." ";
          ?>
        </span>
      </a>
      <!-- Dropdown - User Information -->
      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="changepassword.php">
          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
          Change Password
        </a>

        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="index.php">
          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
          Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
