<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];
	$aid = $_REQUEST['aid'];

	if (isset($_POST['update'])) {
		$quantity = $_POST['Quantity'];
		$adddamaged = $_POST['AddDamaged'];
		$allocate = $_POST['Allocate'];
		$inUse = $_POST['InUse'];
		$damaged = $_POST['Damaged'];
		$inStock = $_POST['InStock'];
		$total = $_POST['Total'];
		$pid = $_POST['PID'];
		$pName = $_POST['PName'];
		$bName = $_POST['BranchName'];
		$dName = $_POST['DepartmentName'];

		$query1 = mysqli_query($con, "UPDATE allocationdetails SET quantity = ('$quantity' + '$allocate' - '$adddamaged') WHERE aid = '$aid'");
		$query2 = mysqli_query($con, "UPDATE productstock SET inUse = ('$inUse' + '$allocate'), inStock = ('$inStock' - '$allocate'), damaged = ('$damaged' + '$adddamaged') WHERE pid = '$pid'");

		if ($query1 && $query2) {
			$msg = "No. of " . $pName . " in " . $dName . " Department of " . $bName . " Branch has been updated successfully.";
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
	        							<h3 class="card-title">Update Product Quantity</h3>
	        						</div>
	        						<div class="card-body">
	        							<?php
				        				$query4 = mysqli_query($con, "SELECT branch.branchName, department.departmentName, department.departmentCode, productdetails.pid, pName, pSpecification, pCompany, pSCategory, cName, quantity, allocationdetails.aid, allocationdetails.entryDate, inUse, damaged, inStock, total FROM productdetails JOIN subcategorydetails ON subcategorydetails.scName = productdetails.pSCategory JOIN categorydetails ON categorydetails.cCode = subcategorydetails.cCode JOIN allocationdetails ON allocationdetails.pid = productdetails.pid JOIN branch ON branch.branchCode = allocationdetails.branchCode JOIN department ON department.departmentCode = allocationdetails.departmentCode JOIN productstock ON productstock.pid = allocationdetails.pid WHERE allocationdetails.aid = '$aid'");
				        				$cnt = 1;
				        				while ($row = mysqli_fetch_array($query4)) {
				        					?>
		        							<form role="form" name="editvendor" method="POST">
		        								<div class="row">
		        									<div class="col-md-4 col-12">
		        										<div class="form-group">
						        							<label>Branch Name</label>
						        							<input type="text" id="BranchName" name="BranchName" class="form-control" value="<?php echo $row['branchName']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Department Name</label>
						        							<input type="text" id="DepartmentName" name="DepartmentName" class="form-control" value="<?php echo $row['departmentName']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Product Category</label>
						        							<input type="text" id="PCategory" name="PCategory" class="form-control" value="<?php echo $row['pSCategory'] . ' - ' . $row['cName']; ?>" readonly>
						        						</div>
						        					</div>
						        					<div class="col-md-4 col-12">
						        						<div class="form-group">
						        							<label>Product Name</label>
						        							<input type="text" id="PName" name="PName" class="form-control" value="<?php echo $row['pName']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Product Specification</label>
						        							<input type="text" id="PSpecification" name="PSpecification" class="form-control" value="<?php echo $row['pSpecification']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Product Company/Manufacturer</label>
						        							<input type="text" id="PCompany" name="PCompany" class="form-control" value="<?php echo $row['pCompany']; ?>" readonly>
						        						</div>
		        									</div>
		        									<div class="col-md-4 col-12">
		        										<!-- NO DISPLAY -->
		        										<div style="display: none;">
						        							<input type="text" id="PID" name="PID" class="form-control" value="<?php echo $row['pid']; ?>" readonly>
						        						</div> 
		        										<div style="display: none;">
						        							<input type="text" id="InUse" name="InUse" class="form-control" value="<?php echo $row['inUse']; ?>" readonly>
						        						</div> 
						        						<div style="display: none;">
						        							<input type="text" id="InStock" name="InStock" class="form-control" value="<?php echo $row['inStock']; ?>" readonly>
						        						</div> 
						        						<div style="display: none;">
						        							<input type="text" id="Damaged" name="Damaged" class="form-control" value="<?php echo $row['damaged']; ?>" readonly>
						        						</div>
						        						<div style="display: none;">
						        							<input type="text" id="Total" name="Total" class="form-control" value="<?php echo $row['total']; ?>" readonly>
						        						</div> 
						        						<!-- END -->
		        										<div class="form-group">
						        							<label><?php echo "No. of " . $row['pName'] . " in use"; ?></label>
						        							<input type="number" id="Quantity" name="Quantity" class="form-control" value="<?php echo $row['quantity']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Allocate</label>
						        							<input type="number" id="Allocate" name="Allocate" class="form-control" min="0" max="<?php echo $row['inStock']; ?>">
						        						</div>
						        						<div class="form-group">
						        							<label>Add to Damaged</label>
						        							<input type="number" id="AddDamaged" name="AddDamaged" class="form-control" min="0" max="<?php echo $row['quantity']; ?>">
						        						</div>
						        
		        									</div>
		        								</div>
		        								<div class="card-footer bg-transparent">
		        									<button type="submit" name="update" class="btn btn-success float-right">Update <?php echo "'" . $row['pName'] . "' to " . $row['departmentCode'] . " Department of " . $row['branchName'] . " Branch";?></button>
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
