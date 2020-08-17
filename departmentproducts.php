<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];
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
		        			<div class="col-md-12">
		        				<div class="card">
		        					<br>
		        					<div class="row">
		        						<div class="col-md-3"></div>
		        						<div class="col-md-3">

		        						</div>
		        						<div class="col-md-2">

		        						</div>
		        						<div class="col-md-2">

		        						</div>
		        						<div class="col-md-2">
		        							<a class="btn btn-outline-success" href="department.php">Add DEPARTMENT</a> 
		        							
		        						</div>
		        						<!-- <div class="col-md-1"></div> -->
		        					</div>
		        					<br>
		        					<div class="card bg-gradient-secondary">
		        						<div class="card-header">
		        							<h3 class="card-title">Product Allocation (Department)</h3>
		        						</div>
		        						<div class="card-body p-0">
		        							<table class="table table-striped">
		        								<thead class="bg-success">
		        									<tr>
		        										<th style="width: 2%;">#</th>
		        										<th style="width: 19%;">Department</th>
		        										<!-- <th style="width: 5%;">PID</th> -->
		        										<th style="width: 19%;">Product Name</th>
		        										<th style="width: 19%;">Product Specification</th>
		        										<th style="width: 19%;">Category</th>
		        										<th style="width: 10%;">Quantity</th>
		        									</tr>
		        								</thead>
		        								<tbody>
		        									<?php
		        									$count = 0;
		        									$i = 0;
		        									$query3 = mysqli_query($con, "SELECT department.departmentName, productdetails.pid, pName, pSpecification, pSCategory, cName, SUM(quantity) as quantity, allocationdetails.entryDate FROM productdetails JOIN subcategorydetails ON subcategorydetails.scName = productdetails.pSCategory JOIN categorydetails ON categorydetails.cCode = subcategorydetails.cCode JOIN allocationdetails ON allocationdetails.pid = productdetails.pid JOIN department ON department.departmentCode = allocationdetails.departmentCode 
		        										GROUP BY departmentName, pName ORDER BY departmentName ASC");
		        									foreach ($query3 as $row) {
		        										$count++;
		        										$i++;
		        										?>
			        									<tr>
			        										<td><?php echo $i; ?></td>
			        										<td><?php echo $row['departmentName']; ?></td>
			        										<td><?php echo $row['pName']; ?></td>
			        										<td><?php echo $row['pSpecification']; ?></td>
			        										<td><?php echo $row['pSCategory'] . " - " . $row['cName']; ?></td>
			        										<td><?php echo $row['quantity']; ?></td>
			        										<!-- <td class="project-actions text-right">	
	                          									<a class="btn btn-primary"  href="editdepartmentad.php?vid=<?php echo $row['vid']; ?>">
	                              									<i class="fas fa-pencil-alt"></i>
	                              									Edit
	                          									</a>
	                      									</td> -->	
			        									</tr>
			        									<?php
			        									if ($count == 6) {
			        										$count = 0;
			        									}
			        								}
			        								?>
		        								</tbody>
		        							</table>
		        						</div>
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
