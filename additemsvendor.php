<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];
	$pid = $_REQUEST['pid'];

	if (isset($_POST['additem'])) {
		$inUse = $_POST['InUse'];
		$damaged = $_POST['Damaged'];
		$inStock = $_POST['InStock'];
		$total = $_POST['Total'];
		$additem = $_POST['AddItem'];
		$vid = $_POST['VID'];
		$rate = $_POST['PRate'];
		$pName = $_POST['PName'];

		$query1 = mysqli_query($con, "UPDATE productstock SET inStock = ('$inStock' + '$additem'), total = ('$inUse' + '$damaged' + '$inStock' + '$additem') WHERE pid = '$pid'");
		$query2 = mysqli_query($con, "INSERT INTO itemsvendor (pid, vid, quantity, totalCost) VALUES ('$pid', '$vid', '$additem', '$rate' * '$additem')");

		if ($query1 && $query2) {
			$msg = $additem . " " . $pName . " have been added to its stock successfully.";
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
	        							<h3 class="card-title">Add More Items in Inventory</h3>
	        						</div>
	        						<div class="card-body">
	        							<?php
	        							// $vid = 
				        				$query4 = mysqli_query($con, "SELECT productdetails.pid, pName, pSpecification, pCompany, pRate, pSCategory, vendordetails.vid, vName, vAddress, inUse, damaged, total, inStock FROM productdetails JOIN subcategorydetails ON subcategorydetails.scName = productdetails.pSCategory JOIN categorydetails ON categorydetails.cCode = subcategorydetails.cCode JOIN productstock ON productstock.pid = productdetails.pid JOIN itemsvendor ON itemsvendor.pid = productdetails.pid JOIN vendordetails ON vendordetails.vid = itemsvendor.vid WHERE productdetails.pid = '$pid' GROUP BY productdetails.pid, vendordetails.vid");
				        				$cnt = 1;
				        				while ($row = mysqli_fetch_array($query4)) {
				        					?>
		        							<form role="form" name="editvendor" method="POST">
		        								<div class="row">
		        									<div class="col-md-5 col-12">
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
						        						<div style="display: none;">
						        							<label>VID</label>
						        							<input type="text" id="VID" name="VID" class="form-control" value="<?php echo $row['vid']; ?>" readonly>
						        						</div> 
						        						<div class="form-group">
						        							<label>Vendor Name</label>
						        							<input type="text" id="VName" name="VName" class="form-control" value="<?php echo $row['vName']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Address</label>
						        							<input type="text" id="VAddress" name="VAddress" class="form-control" value="<?php echo $row['vAddress']; ?>" readonly>
						        						</div>
						        						<div class="form-group">
						        							<label>Product Rate</label>
						        							<input type="text" id="PRate" name="PRate" class="form-control" value="<?php echo $row['pRate']; ?>" readonly>
						        						</div>
		        									</div>
		        									<div class="col-md-3 col-12">
		        										<div class="row">
		        											<div class="col-md-6 col-12">
		        												<div class="form-group">
								        							<label>In Use Quantity</label>
								        							<input type="number" id="InUse" name="InUse" class="form-control" value="<?php echo $row['inUse']; ?>" readonly>
								        						</div>
		        											</div>
		        											<div class="col-md-6 col-12">
		        												<div class="form-group">
								        							<label>Damaged Quantity</label>
								        							<input type="number" id="Damaged" name="Damaged" class="form-control" value="<?php echo $row['damaged']; ?>" readonly>
								        						</div>
		        											</div>
		        										</div>
		        										<div class="row">
		        											<div class="col-md-6 col-12">
		        												<div class="form-group">
								        							<label>In Stock Quantity</label>
								        							<input type="number" id="InStock" name="InStock" class="form-control" value="<?php echo $row['inStock']; ?>" readonly>
								        						</div>
		        											</div>
		        											<div class="col-md-6 col-12">
		        												<div class="form-group">
								        							<label>Total Quantity</label>
								        							<input type="number" id="Total" name="Total" class="form-control" value="<?php echo $row['total']; ?>" readonly>
								        						</div>
		        											</div>
		        										</div>
		        										<div class="form-group">
						        							<label>Add to Inventory</label>
						        							<input type="number" id="AddItem" name="AddItem" class="form-control" min="1" max="100">
						        						</div>
						        						
						        
		        									</div>
		        								</div>
		        								<div class="card-footer bg-transparent">
		        									<button type="submit" name="additem" class="btn btn-success float-right">ADD MORE <?php echo "'" . $row['pName'] . "'";?> TO INVENTORY</button>
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
