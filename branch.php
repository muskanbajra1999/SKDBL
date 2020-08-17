<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];

	if (isset($_POST['addbranch'])) {
		$branchCode = $_POST['BranchCode'];
		$branchName = $_POST['BranchName'];
		$branchLocation = $_POST['BranchLocation'];
		$establishedDate = $_POST['EstablishedDate'];

		$query1 = mysqli_query($con, "INSERT INTO branch (branchCode, branchName, location, establishedDate) VALUES ('$branchCode', '$branchName', '$branchLocation', '$establishedDate')");

		if ($query1) {
			$msg = $branchName . " Branch has been added successfully.";
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
		        		<div class="card bg-gradient-secondary">
    						<div class="card-header">
    							<h3 class="card-title">Branch Details</h3>
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
    										<th style="width: 5%;">#</th>
    										<th style="width: 15%;">Branch Code</th>
    										<th style="width: 15%;">Branch Number</th>
    										<!-- <th style="width: 5%;">PID</th> -->
    										<th style="width: 20%;">Branch Name</th>
    										<th style="width: 25%;">Branch Location</th>
    										<th style="width: 20%;">Establishment Date</th>
    										<!-- <th style="width: 7%;"></th> -->
    									</tr>
    								</thead>
    								<tbody>
    									<?php
    									$count = 0;
    									$i = 0;
    									$query3 = mysqli_query($con, "SELECT branchNo, branchCode, branchName, location, establishedDate FROM branch
    									ORDER BY establishedDate ASC");
    									foreach ($query3 as $row) {
    										$count++;
    										$i++;
    										?>
        									<tr>
        										<td><?php echo $i; ?></td>
        										<td><?php echo $row['branchCode']; ?></td>
        										<td><?php echo $row['branchNo']; ?></td>
        										<td><?php echo $row['branchName']; ?></td>
        										<td><?php echo $row['location']; ?></td>
        										<td><?php echo $row['establishedDate']; ?></td>
        											
        									</tr>
        									<?php
        									if ($count == 5) {
        										$count = 0;
        									}
        								}
        								?>
    								</tbody>
    							</table>
    						</div>
    					</div>
	        			<div class="row">
	        				<div class="col-md-2"></div>
	        				<div class="col-md-8">
	        					<div class="card card-success">
	        						<div class="card-header">
	        							<h3 class="card-title">Add Branch</h3>
	        							<div class="card-tools">
											<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
		  										<i class="fas fa-minus"></i>
		  									</button>
		  								</div>
	        						</div>
	        						<div class="card-body">
		        						<form role="form" name="editvendor" method="POST">
		        							<div class="row">
		        								<div class="col-md-3 col-12">
					        						<div class="form-group">
					        							<?php
														foreach($con->query("SELECT COUNT(branchCode)
														FROM branch") as $row) {
															$result = $row['COUNT(branchCode)'];
														}
														?>
					        							<label>Branch Number</label>
					        							<input type="text" id="BranchNo" name="BranchNo" class="form-control" value="<?php echo $result + 1; ?> " readonly>
					        						</div>
					        						<div class="form-group">
					        							<label>Branch Code</label>
					        							<input type="text" id="BranchCode" name="BranchCode" class="form-control" min-length="3" max-length="3" pattern="[A-Z]{3}" placeholder="3 capital letters only" required="true">
					        						</div>
					        					</div>
					        					<div class="col-md-5 col-12">
					        						<div class="form-group">
					        							<label>Branch Name</label>
					        							<input type="text" id="BranchName" name="BranchName" class="form-control" required="true">
					        						</div>
					        						<div class="form-group">
					        							<label>Branch Location</label>
					        							<input type="text" id="BranchLocation" name="BranchLocation" class="form-control" required="true">
					        						</div>
	        									</div>
	        									<div class="col-md-4 col-12">
	        										<div class="form-group">
					        							<label>Date of Establishment</label>
					        							<input type="date" id="EstablishedDate" name="EstablishedDate" class="form-control">
					        						</div>
					        						<div class="form-group">
					        							<br><br>
			        									<button type="submit" name="addbranch" class="btn btn-success float-right">Add New BRANCH</button>
			        								</div>
	        									</div>
	        								</div>
	        							</form>
		    						</div>
		    					</div>
		    				</div>
		    				<div class="col-md-2"></div>
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
