<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];
	$vid = $_REQUEST['vid'];
	$query1 = mysqli_query($con, "SELECT * FROM vendordetails WHERE vid = '$vid'");
	$row = mysqli_fetch_assoc($query1);

	if (isset($_POST['editvendor'])) {
		$vName = $_POST['VName'];
		$vAddress = $_POST['VAddress'];
		$vOwner = $_POST['VOwner'];
		$vContactNo = $_POST['VContact'];
		$vAltContactNo = $_POST['VAltContactNo'];
		$vEmail = $_POST['VEmail'];

		$query2 = mysqli_query($con, "UPDATE vendordetails SET vName = '$vName', vAddress = '$vAddress', vContactNo = '$vContactNo', vAltContactNo = '$vAltContactNo', vEmail = '$vEmail', vOwner = '$vOwner' WHERE vid = '$vid'");

		if ($query2) {
			$msg = "Vendor details have been updated successfully.";
		}
		else {
			$msg = "Something went wrong. Please try again.";
		}
	}
	
	?>

	<!DOCTYPE html>
  	<html>
	  	<head>
	    	<meta charset="utf-8">
	    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    	<title>SKDBL | Inventory</title>
	    	<meta name="viewport" content="width=device-width, initial-sclae1">
	    	<meta name="viewport" content="width=device-width, initial-scale=1">
		  	<link rel="stylesheet" href="requires/vendor/fontawesome-free/css/all.min.css">
		  	<link rel="stylesheet" href="requires/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		  	<link rel="stylesheet" href="requires/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		  	<link rel="stylesheet" href="requires/plugins/jqvmap/jqvmap.min.css">
		  	<link rel="stylesheet" href="requires/dist/css/adminlte.min.css">
		  	<link rel="stylesheet" href="requires/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		  	<link rel="stylesheet" href="requires/plugins/daterangepicker/daterangepicker.css">
		  	<link rel="stylesheet" href="requires/plugins/summernote/summernote-bs4.css">
		  	<link rel="icon" type="image/png" href="images/logo/pngLogo.png"/>
	  	</head>

	  	<body class="hold-transition sidebar-mini layout-fixed">
		    <div class="wrapper">
		      	<?php include_once('header.php'); ?>
		      	<?php include_once('sidebar.php'); ?>

		      	<div class="content-wrapper">
		        	<div class="container-fluid">
		        		<p style="font-size:16px; color:red" align="center">
		              		<?php
		              		if($msg) {
		                		echo $msg;
		              		}
		              		?>
		            	</p>
		        		<br>
	        			<div class="row">
	        				<div class="col-md-1"></div>
	        				<div class="col-md-10">
	        					<div class="card card-success">
	        						<div class="card-header">
	        							<h3 class="card-title">Edit Vendor Details</h3>
	        						</div>
	        						<div class="card-body">
	        							<?php
	        							$vid = 
				        				$query4 = mysqli_query($con, "SELECT * FROM vendordetails WHERE vid = '$vid'");
				        				$cnt = 1;
				        				while ($row = mysqli_fetch_array($query4)) {
				        					?>
		        							<form role="form" name="editvendor" method="POST">
		        								<div class="row">
		        									<div class="col-md-6 col-12">
						        						<div class="form-group">
						        							<label>Vendor Name</label>
						        							<input type="text" id="VName" name="VName" class="form-control" value="<?php echo $row['vName']; ?>">
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Address</label>
						        							<input type="text" id="VAddress" name="VAddress" class="form-control" required="true" value="<?php echo $row['vAddress']; ?>">
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Owner</label>
						        							<input type="text" id="VOwner" name="VOwner" class="form-control" value="<?php echo $row['vOwner']; ?>">
						        						</div>
		        									</div>
		        									<div class="col-md-6 col-12">
		        										<div class="form-group">
						        							<label>Vendor Contact No</label>
						        							<div class="input-group">
							        							<input type="number" class="form-control" id="VContact" name="VContact" min="9800000000" max="9999999999" required="true" value="<?php echo $row['vContactNo']; ?>">
					                              				<div class="input-group-prepend">
					                            					<span class="input-group-text"><i class="fas fa-phone"></i></span>
					                              				</div>
					                              			</div>
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Landline No</label>
						        							<div class="input-group">
							        							<input type="number" class="form-control" id="VAltContactNo" name="VAltContactNo" min="100000" max="999999" value="<?php echo $row['vAltContactNo']; ?>">
					                              				<div class="input-group-prepend">
					                            					<span class="input-group-text"><i class="fas fa-phone"></i></span>
					                              				</div>
					                              			</div>
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Email Address</label>
						        							<div class="input-group">
							        							<input type="text" id="VEmail" name="VEmail" class="form-control" value="<?php echo $row['vEmail']; ?>">
							        							<div class="input-group-prepend">
							        								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							        							</div>
							        						</div>
						        						</div>
		        									</div>
		        								</div>
		        								<div class="card-footer bg-transparent">
		        									<button type="submit" name="editvendor" class="btn btn-success float-right">UPDATE VENDOR DETAILS</button>
		        								</div>
		        							</form>
		        							<?php
		        						}
		        						?>
	        						</div>
	        					</div>
	        				</div>
	        				<div class="col-md-1"></div>
	        			</div>

		        	</div>
		      	</div>
		    </div>
		 
		    <?php include_once('footer.php')?>

			<script src="requires/vendor/jquery/jquery.min.js"></script>
			<script src="requires/plugins/jquery-ui/jquery-ui.min.js"></script>
			<script>
			  $.widget.bridge('uibutton', $.ui.button)
			</script>
			<script src="requires/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
			<script src="requires/plugins/chart.js/Chart.min.js"></script>
			<script src="requires/plugins/sparklines/sparkline.js"></script>
			<!-- <script src="requires/plugins/jqvmap/jquery.vmap.min.js"></script> -->
			<!-- <script src="requires/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
			<script src="requires/plugins/jquery-knob/jquery.knob.min.js"></script>
			<script src="requires/plugins/moment/moment.min.js"></script>
			<script src="requires/plugins/daterangepicker/daterangepicker.js"></script>
			<script src="requires/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
			<script src="requires/plugins/summernote/summernote-bs4.min.js"></script>
			<script src="requires/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
			<script src="requires/dist/js/adminlte.js"></script>
			<script src="requires/dist/js/pages/dashboard.js"></script>
			<script src="requires/dist/js/demo.js"></script>
	  	</body>
  	</html>
  	<?php
}
?>
