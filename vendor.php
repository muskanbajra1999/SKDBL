<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['uid'] == 0)) {
  header('location:index.php');
}
else {
	$lid = $_SESSION['uid'];

	if (isset($_POST['addvendor'])) {
		$vName = $_POST['VendorName'];
		$vAddress = $_POST['VendorAddress'];
		$vOwner = $_POST['VendorOwner'];
		$vContactNo = $_POST['VendorContact'];
		$vAltContactNo = $_POST['VendorAltContactNo'];
		$vEmail = $_POST['VendorEmail'];

		$query1 = mysqli_query($con, "INSERT INTO vendordetails (vName, vAddress, vContactNo, vAltContactNo, vEmail, vOwner) VALUES ('$vName', '$vAddress', '$vContactNo', '$vAltContactNo', '$vEmail', '$vOwner')");

		if ($query1) {
			$msg = "New Vendor is added successfully.";
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
		        			<div class="col-md-12">
	        					<div class="card bg-gradient-secondary">
	        						<div class="card-header">
	        							<h3 class="card-title">Vendor Details</h3>
	        							<div class="card-tools">
        									<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          										<i class="fas fa-minus"></i>
          									</button>
          									<button type="button" class="btn btn-tool" onclick="myFunction1()" name="Add">
              									<i class="fas fa-plus"></i>
              								</button>
      									</div>
	        						</div>
	        						<div class="card-body p-0">
	        							<table class="table table-striped">
	        								<thead class="bg-success">
	        									<tr>
	        										<th style="width: 1%;">#</th>
	        										<th style="width: 2%;">VID</th>
	        										<th style="width: 20%;">Vendor Name</th>
	        										<th style="width: 17%;">Address</th>
	        										<th style="width: 10%;">Contact No.</th>
	        										<th style="width: 10%;">Alternate Contact</th>
	        										<th style="width: 17%;">Email Address</th>
	        										<th style="width: 16%;">Owner Name</th>
	        										<th style="width: 7%;"></th>
	        									</tr>
	        								</thead>
	        								<tbody>
	        									<?php
	        									$count = 0;
	        									$i = 0;
	        									$query3 = mysqli_query($con, "SELECT * FROM vendordetails");
	        									foreach ($query3 as $row) {
	        										$count++;
	        										$i++;
	        										?>
		        									<tr>
		        										<td><?php echo $i; ?></td>
		        										<td><?php echo $row['vid']; ?></td>
		        										<td><?php echo $row['vName']; ?></td>
		        										<td><?php echo $row['vAddress']; ?></td>
		        										<td><?php echo $row['vContactNo']; ?></td>
		        										<td><?php echo $row['vAltContactNo']; ?></td>
		        										<td><?php echo $row['vEmail']; ?></td>
		        										<td><?php echo $row['vOwner']; ?></td>
		        										<td class="project-actions text-right">	
                          									<a class="btn btn-primary btn-sm"  href="editvendor.php?vid=<?php echo $row['vid']; ?>">
                              									<i class="fas fa-pencil-alt"></i>
                              									Edit
                          									</a>
                      									</td>	
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

		        		<div id="Add" style="display: none;">
		        			<div class="row">
			        			<div class="col-md-1"></div>
			        			<div class="col-md-10 col-12">
			        				<div class="card card-success">
			        					<div class="card-header">
			        						<h3 class="card-title">Add Vendor Details</h3>
			        					</div>
			        					<div class="card-body">
			        						<form role="form" name="addvendor" method="POST">
				        						<div class="row">
				        							<div class="col-md-6 col-12">
				        								<div class="form-group">
						        							<label>Vendor Name</label>
						        							<input type="text" id="VendorName" name="VendorName" class="form-control">
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Address</label>
						        							<input type="text" id="VendorAddress" name="VendorAddress" class="form-control" required="true">
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Owner</label>
						        							<input type="text" id="VendorOwner" name="VendorOwner" class="form-control">
						        						</div>
				        							</div>
				        							<div class="col-md-6 col-12">
				        								<div class="form-group">
						        							<label>Vendor Contact No</label>
						        							<div class="input-group">
							        							<input type="number" class="form-control" id="VendorContact" name="VendorContact" min="9800000000" max="9999999999" required="true">
					                              				<div class="input-group-prepend">
					                            					<span class="input-group-text"><i class="fas fa-phone"></i></span>
					                              				</div>
					                              			</div>
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Landline No</label>
						        							<div class="input-group">
							        							<input type="number" class="form-control" id="VendorAltContactNo" name="VendorAltContactNo" min="100000" max="999999">
					                              				<div class="input-group-prepend">
					                            					<span class="input-group-text"><i class="fas fa-phone"></i></span>
					                              				</div>
					                              			</div>
						        						</div>
						        						<div class="form-group">
						        							<label>Vendor Email Address</label>
						        							<div class="input-group">
							        							<input type="text" id="VendorEmail" name="VendorEmail" class="form-control">
							        							<div class="input-group-prepend">
							        								<span class="input-group-text"><i class="fas fa-envelope"></i></span>
							        							</div>
							        						</div>
						        						</div>
				        							</div>
				        						</div>	
				        						<div class="card-footer bg-transparent">
							        				<button type="submit" name="addvendor" class="btn btn-success float-right">ADD VENDOR</button>
					        					</div>
					        				</form>
			        					</div>
					        		</div>
			        			</div>
		        				<div class="col-md-1"></div>
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
			<script>
			    function myFunction1() {
			      var x = document.getElementById("Add");
			      if (x.style.display == "none") {
			        x.style.display = "block";
			      }
			      else {
			        x.style.display = "none";
			      }
			    }
			</script>
	  	</body>
  	</html>
  	<?php
}
?>
