<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(strlen($_SESSION['uid']==0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];

	// if (isset($_POST['newvendor'])) {
	// 	header('location:addvendor.php');
	// }
	
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
		  	<link rel="stylesheet" href="requires/css/main.css">
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
		        			<div class="col-md-5 col-12">
		        				<div class="card card-success">
		        					<div class="card-header">
		        						<h3 class="card-title">Product Details</h3>
		        					</div>
		        					<div class="card-body">
		        						<div class="form-group">
		        							<label>Product Name</label>
		        							<input type="text" id="ProductName" name="ProductName" class="form-control" required="true">
		        						</div>
		        						<div class="form-group">
		        							<label>Product Model/Code/Specification</label>
		        							<input type="text" id="ProductCode" name="ProductCode" class="form-control" required="true">
		        						</div>
		        						<div class="form-group">
		        							<label>Product Company</label>
		        							<input type="text" id="ProductCompany" name="ProductCompany" class="form-control">
		        						</div>
		        						<div class="form-group">
		        							<label>Product Rate</label>
		        							<input type="number" id="ProductRate" name="ProductRate" class="form-control" required="true">
		        						</div>
		        						<div class="form-group">
		        							<label>Product Sub Category</label>
		        							<p>
				                              	<select name="ProductSubC" id="ProductSubC" class="form-control">
				                                  	<?php
				                                  	$sql2 = "SELECT scName from subcategorydetails";
				                                  	$query2 = $dbh->prepare($sql2);
				                                  	$query2 -> execute();
				                                  	$results2 = $query2 -> fetchAll(PDO::FETCH_OBJ);
				                                  	$cnt = 1;
				                                  	if ($query2 -> rowCount() > 0) {
				                                    	foreach ($results2 as $result2) {
				                                        	?>
				                                        	<option value="<?php echo htmlentities($result2->scName);?>"><?php echo htmlentities($result2->scName);?></option>
				                                        	<?php
				                                      	}
				                                    }
				                                	?>
				                              	</select>
				                            </p>
		        						</div>
		        					</div>
		        				</div>
		        			</div>
		        			<div class="col-md-5 col-12">
		              			<div class="card card-success">
		                			<div class="card-header">
		                  				<h3 class="card-title">Product Quantity</h3>
		                			</div>
		                			<div class="card-body">
		                  				<div class="form-group">
		                    				<label>Quantity of product</label>
		                    				<input type="number" id="ProductName" name="ProductName" class="form-control">
		                  				</div>
		                  				<div class="form-group">
		                    				<label>Total Cost of Product</label>
		                    				<input type="text" id="ProductCode" name="ProductCode" class="form-control">
		                  				</div>
						                <!-- <div class="form-group">
						                    <label>Product Company</label>
						                    <input type="text" id="ProductCompany" name="ProductCompany" class="form-control">
						                </div>
						                <div class="form-group">
						                    <label>Product Rate</label>
						                    <input type="number" id="ProductRate" name="ProductRate" class="form-control">
						                </div> -->
		                			</div>
		              			</div>
		              			<div class="card card-success">
		                			<div class="card-header">
		                  				<h3 class="card-title">Vendor</h3>
		                			</div>
		                			<div class="card-body">
		                  				<div class="form-group">
		                    				<label>Vendor Name</label>
		                    				<div class="row">
		                    					<div class="col-md-9">
		                    						<p>
						                              	<select name="Vendor" id="Vendor" class="form-control">
						                                  	<?php
						                                  	$sql2 = "SELECT vName, vAddress from vendordetails";
						                                  	$query2 = $dbh->prepare($sql2);
						                                  	$query2 -> execute();
						                                  	$results2 = $query2 -> fetchAll(PDO::FETCH_OBJ);
						                                  	$cnt = 1;
						                                  	if ($query2 -> rowCount() > 0) {
						                                    	foreach ($results2 as $result2) {
						                                        	?>
						                                        	<option value="<?php echo htmlentities($result2->vName) . ", " . htmlentities($result2->vAddress);?>"><?php echo htmlentities($result2->vName) . ", " . htmlentities($result2->vAddress);?></option>
						                                        	<?php
						                                      	}
						                                    }
						                                	?>
						                              	</select>
						                            </p>
		                    					</div>
		                    					<div class="col-md-3">
		                    						<a href="vendor.php"><button type="submit" class="btn btn-block btn-outline-success">New Vendor</button></a>
		                    					</div>
		                    				</div>
		                  				</div>
		                			</div>
		              			</div>
		        			</div>
		        		</div>
		        		<div class="card-footer" style="background: transparent;">
		        			<div class="col-md-11">
		        				<button type="submit" name="submit" class="btn btn-success float-right">ADD PRODUCT</button>
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
	  	</body>
  	</html>
  	<?php
}
?>
