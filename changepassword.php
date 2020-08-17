<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid']==0)) {
  header('location:index.php');
}
else {
  if (isset($_POST['submit'])) {
    $password=$_POST['password'];
    $confirmPassword=$_POST['confirmPassword'];
    $newPassword=$_POST['newPassword'];
    $eid=$_SESSION['uid'];
    $sql = "SELECT password FROM personaldetails WHERE id= :eid AND password= md5(:password)";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query -> bindParam(':password', $password, PDO::PARAM_STR);
    $query -> execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if ($newPassword <> $confirmPassword) {
      $msg = "Your new password confirmation doesnot match.";
    }
    else {
      if ($query->rowCount() > 0) {
        $con = "UPDATE personaldetails SET password = md5(:newPassword) WHERE id = :eid";
        $changePw = $dbh->prepare($con);
        $changePw -> bindParam(':eid', $eid, PDO::PARAM_STR);
        $changePw -> bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $changePw->execute();
        $msg = "Your password has been changed successfully.";
      }
      else {
        $msg = "The current password is wrong.";
        header("Location:home.php");
      }
    }
  }

  elseif (isset($_POST['home'])) {
    header("Location:home.php");
  }
  ?>

  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SKDBL | Dashboard</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="requires/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="requires/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="requires/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="requires/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="requires/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="requires/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="requires/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="requires/plugins/summernote/summernote-bs4.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include_once('header.php');?>
    <?php include_once('sidebar.php');?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <p style="font-size:16px; color:red" align="center">
          <?php
          if($msg) {
            echo $msg;
          }
          ?>
        </p>

        <div class="card card-primary">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-title">Change Password</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-4"></div>

              <div class="col-md-4">
                <form name="changepassword" class="user" method="post" onsubmit="return checkPassword();">
                  <?php
                  $eid = $_SESSION['uid'];
                  $ret = mysqli_query($con, "SELECT * FROM personaldetails WHERE id='$eid'");
                  $cnt = 1;
                  while ($row = mysqli_fetch_array($ret)) {
                    ?>
                    <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" value="" required="true" placeholder="Current Password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="input-group">
                      <input type="password" class="form-control" id="newPassword" name="newPassword" value="" required="true" placeholder="New Password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="input-group">
                      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="" required="true" placeholder="Confirm Password">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-lock"></span>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="input-group" align="center">
                      <input type="submit" name="submit" value="Change Password" class="btn btn-primary" style="position: relative; left: 5%;">
                      <?php
                    }
                    ?>
                    <br>
                    <button type="submit" name="home" class="btn btn-success" style="position: relative; left: 10%;">Back to Dashboard</button>
                  </div>
                </form>
              </div>
              <div class="col-md-4"></div>
            </div>

          </div>
        </div>


      </div>
    </div>
  </div>

  <?php include_once('footer.php') ?>

  <script src="requires/vendor/jquery/jquery.min.js"></script>
  <script src="requires/plugins/jquery-ui/jquery-ui.min.js"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="requires/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="requires/plugins/chart.js/Chart.min.js"></script>
  <script src="requires/plugins/sparklines/sparkline.js"></script>
  <script src="requires/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="requires/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <script src="requires/plugins/jquery-knob/jquery.knob.min.js"></script>
  <script src="requires/plugins/moment/moment.min.js"></script>
  <script src="requires/plugins/daterangepicker/daterangepicker.js"></script>
  <script src="requires/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <script src="requires/plugins/summernote/summernote-bs4.min.js"></script>
  <script src="requires/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="requires/dist/js/adminlte.js"></script>
  <script src="requires/dist/js/pages/dashboard.js"></script>
  <script src="requires/dist/js/demo.js"></script>

  <script>
  function checkPassword() {
    if (document.changePassword.newPassword.value!=document.changePassword.confirmPassword.value) {
      alert('New Password and Confirm Password field does not match.');
      document.changePassword.confirmPassword();
      return false;
    }
    return true;
  }
  </script>

  </body>
  </html>

  <?php
}
 ?>
