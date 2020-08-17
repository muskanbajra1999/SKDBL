<?php
session_start();
session_destroy();
session_start();
error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbconnection.php');

if(isset($_POST['login'])) {
  	$userName = $_POST['UserName'];
  	$password = md5($_POST['Password']);
  	$query = mysqli_query($con,"select id from personaldetails where userName = '$userName' && password = '$password'");
  	$row = mysqli_fetch_array($query);
  	$ids = $row['id'];
  	header('location:home.php');

  	if ($ids > 0) {
    	$_SESSION['uid'] = $row['id'];
    	$_SESSION['userName'] = $row['userName'];
    	$_SESSION['password'] = $row['password'];
    	header('location:home.php');
  	}

  	else {
    	$msg = 'Invalid Details.';
  	}
}
?>

<!DOCTYPE html>
<html>
  	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<title>SKDBL | Login</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="requires/vendor/fontawesome-free/css/all.min.css">
    	<link rel="stylesheet" href="requires/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    	<link rel="stylesheet" href="requires/dist/css/adminlte.min.css">
    	<link rel="icon" type="image/png" href="images/logo/pngLogo.png">
  	</head>

  	<body class="hold-transition login-page" style="background-image: url('images/background/download.jpg'); background-size: cover;">
    	<div class="login-box">
      		<div class="login-logo">
        		<a href="#"><b>SKDBL</b>Inventory</a>
      		</div>

      		<div class="card">
        		<div class="card-body login-card-body">          
        			<form action="" method="post">
            			<div class="input-group mb-3">
              				<input type="text" class="form-control" id="UserName" name="UserName" placeholder="UserName" required="true">
              				<div class="input-group-append">
                				<div class="input-group-text">
                  					<span class="fas fa-envelope"></span>
                				</div>
              				</div>
            			</div>
            			<div class="input-group mb-3">
              				<input type="password" class="form-control" id="Password" name="Password" placeholder="Password" required="true">
              				<div class="input-group-append">
                				<div class="input-group-text">
                  					<span class="fas fa-lock"></span>
                				</div>
              				</div>
            			</div>
            			<div class="row">
                			<button type="submit" class="btn btn-success btn-block" name="login">Login</button>
            			</div>
          			</form>
        		</div>
      		</div>
    	</div>

    	<script src="requires/vendor/jquery/jquery.min.js"></script>
    	<script src="requires/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    	<script src="requires/dist/js/adminlte.min.js"></script>

  	</body>
</html>
