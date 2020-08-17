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
	        					<div class="card bg-gradient-secondary">
	        						<div class="card-header">
	        							<h3 class="card-title">Product Details</h3>
	        							<div class="card-tools">
          									<a type="button" class="btn btn-tool" href="productentry.php">
              									<i class="fas fa-plus"></i>
              								</a>
      									</div>
	        						</div>
	        						<div class="card-body p-0">
	        							<table class="table table-striped">
	        								<thead class="bg-success">
	        									<tr>
	        										<th style="width: 2%;">#</th>
	        										<th style="width: 3%;">PID</th>
	        										<th style="width: 13%;">Product Name</th>
	        										<th style="width: 13%;">Product Specification</th>
	        										<th style="width: 13%;">Product Company</th>
	        										<th style="width: 9%;">Product Rate</th>
	        										<th style="width: 17%;">Category</th>
	        										<th style="width: 7%;">Total</th>
	        										<th style="width: 7%;">In Use</th>
	        										<th style="width: 7%;">Damaged</th>
	        										<th style="width: 7%;">In Stock</th>
	        									</tr>
	        								</thead>
	        								<tbody>
	        									<?php
	        									$count = 0;
	        									$i = 0;
	        									$query3 = mysqli_query($con, "SELECT productdetails.pid, pName, pSpecification, pCompany, pRate, pSCategory, cName, total, inUse, damaged, inStock FROM productdetails JOIN subcategorydetails ON subcategorydetails.scName = productdetails.pSCategory JOIN categorydetails ON categorydetails.cCode = subcategorydetails.cCode JOIN productstock ON productstock.pid = productdetails.pid");
	        									foreach ($query3 as $row) {
	        										$count++;
	        										$i++;
	        										?>
		        									<tr>
		        										<td><?php echo $i; ?></td>
		        										<td><?php echo $row['pid']; ?></td>
		        										<td><?php echo $row['pName']; ?></td>
		        										<td><?php echo $row['pSpecification']; ?></td>
		        										<td><?php echo $row['pCompany']; ?></td>
		        										<td><?php echo $row['pRate']; ?></td>
		        										<td><?php echo $row['pSCategory'] . " - " . $row['cName']; ?></td>
		        										<td><?php echo $row['total']; ?></td>
		        										<td><?php echo $row['inUse']; ?></td>
		        										<td><?php echo $row['damaged']; ?></td>
		        										<td><?php echo $row['inStock']; ?></td>
		        										<!-- <td class="project-actions text-right">	
                          									<a class="btn btn-primary btn-sm"  href="editvendor.php?vid=<?php echo $row['vid']; ?>">
                              									<i class="fas fa-pencil-alt"></i>
                              									Edit
                          									</a>
                      									</td> -->	
		        									</tr>
		        									<?php
		        									if ($count == 8) {
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
