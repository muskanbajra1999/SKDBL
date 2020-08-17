<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];

	if (isset($_POST['adddepartment'])) {
		$departmentCode = $_POST['DepartmentCode'];
		$departmentName = $_POST['DepartmentName'];

		$query1 = mysqli_query($con, "INSERT INTO department (departmentCode, departmentName) VALUES ('$departmentCode', '$departmentName')");

		if ($query1) {
			$msg = $departmentName . "  Department has been added successfully.";
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
		        			<div class="col-md-7 col-12">
		        				<div class="card bg-gradient-secondary">
		    						<div class="card-header">
		    							<h3 class="card-title">Department Details</h3>
		    							<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
		  										<i class="fas fa-minus"></i>
		  									</button>
		  								</div>
		    						</div>
		    						<div class="card-body p-0">
		    							<table class="table table-striped">
		    								<thead class="bg-success">
		    									<tr>
		    										<th style="width: 10%;">#</th>
		    										<th style="width: 20%;">Department Code</th>
		    										<th style="width: 25%;">Department Name</th>
		    									</tr>
		    								</thead>
		    								<tbody>
		    									<?php
		    									$count = 0;
		    									$i = 0;
		    									$query3 = mysqli_query($con, "SELECT departmentNo, departmentCode, departmentName FROM department
		    									ORDER BY departmentName ASC");
		    									foreach ($query3 as $row) {
		    										$count++;
		    										$i++;
		    										?>
		        									<tr>
		        										<td><?php echo $i; ?></td>
		        										<td><?php echo $row['departmentCode']; ?></td>
		        										<td><?php echo $row['departmentName']; ?></td>
		        									</tr>
		        									<?php
		        									if ($count == 3) {
		        										$count = 0;
		        									}
		        								}
		        								?>
		    								</tbody>
		    							</table>
		    						</div>
		    					</div>
		        			</div>
		        			<div class="col-md-5 col-12">
		        				<div class="card card-success">
	        						<div class="card-header">
	        							<h3 class="card-title">Add Department</h3>
	        							<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
		  										<i class="fas fa-minus"></i>
		  									</button>
		  								</div>
	        						</div>
	        						<div class="card-body">
		        						<form role="form" name="editvendor" method="POST">
		        							<div class="row">
		        								<div class="col-md-6">
		        									<div class="form-group">
					        							<?php
														foreach($con->query("SELECT COUNT(departmentCode)
														FROM department") as $row) {
															$result = $row['COUNT(departmentCode)'];
														}
														?>
					        							<label>Department Number</label>
					        							<input type="text" id="DepartmentNo" name="DepartmentNo" class="form-control" value="<?php echo $result + 1; ?> " readonly>
					        						</div>
		        								</div>
		        								<div class="col-md-6">
		        									<div class="form-group">
					        							<label>Department Code</label>
					        							<input type="text" id="DepartmentCode" name="DepartmentCode" class="form-control" min-length="2" max-length="2" pattern="[A-Z]{2}" placeholder="2 capital letters only" required="true">
					        						</div>
		        								</div>
		        							</div>
			        						<div class="form-group">
			        							<label>Department Name</label>
			        							<input type="text" id="DepartmentName" name="DepartmentName" class="form-control" required="true">
			        						</div>
			        						<br>
			        						<div class="form-group">
	        									<button type="submit" name="adddepartment" class="btn btn-success float-right">Add New DEPARTMENT</button>
	        								</div>
	        							</form>
		    						</div>
		    					</div>
		        			</div>
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
