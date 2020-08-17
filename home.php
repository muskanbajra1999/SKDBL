<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(strlen($_SESSION['uid'] == 0)){
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
		  	<meta name="viewport" content="width=device-width, initial-scale=1">
		  	<link rel="stylesheet" href="requires/vendor/fontawesome-free/css/all.min.css">
		  	<link rel="stylesheet" href="requires/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
		  	<link rel="stylesheet" href="requires/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
		  	<link rel="stylesheet" href="requires/plugins/jqvmap/jqvmap.min.css">
		  	<link rel="stylesheet" href="requires/dist/css/adminlte.min.css">
		  	<link rel="stylesheet" href="requires/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		  	<link rel="stylesheet" href="requires/plugins/daterangepicker/daterangepicker.css">
		  	<link rel="stylesheet" href="requires/plugins/summernote/summernote-bs4.css">
			<link rel="stylesheet" href="requires/css/style.css">
			<link rel="icon" type="image/png" href="images/logo/pngLogo.png"/>
		</head>
		<body class="hold-transition sidebar-mini layout-fixed">
			<div class="wrapper">

				<?php include_once('header.php')?>
				<?php include_once('sidebar.php')?>

				<div class="content-wrapper">
					<div class="container-fluid">

						<div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

						<!--Dashboard Content Start -->
						<div class="row">
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<?php
										foreach($con->query("SELECT SUM(inUse)
										FROM productstock") as $row) {
											$result = $row['SUM(inUse)'];
										}
										?>
										<h3><?php echo $result; ?></h3>
										<p>Items in Use</p>
									</div>
									<a href="products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
									<!--<a href="leavebalance.php?llid='Sick Leave'" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>-->
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-success">
									<div class="inner">
										<?php
										foreach($con->query("SELECT SUM(inStock)
										FROM productstock") as $row) {
											$result = $row['SUM(inStock)'];
										}
										?>
										<h3><?php echo $result; ?></h3>
										<p>Items in Stock</p>
									</div>
									<a href="products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-danger">
									<div class="inner">
										<?php
										foreach($con->query("SELECT SUM(damaged)
										FROM productstock") as $row) {
											$result = $row['SUM(damaged)'];
										}
										?>
										<h3><?php echo $result; ?></h3>
										<p>Items Damaged</p>
									</div>
									<a href="products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<div class="col-lg-3 col-6">
								<div class="small-box bg-warning">
									<div class="inner">
										<?php
										foreach($con->query("SELECT SUM(total)
										FROM productstock") as $row) {
											$result = $row['SUM(total)'];
										}
										?>
										<h3><?php echo $result; ?></h3>
										<p>Quantity in Total</p>
									</div>
									<a href="products.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="card">
					              	<div class="card-header">
					                	<h3 class="card-title">
					                  		<i class="far fa-chart-bar"></i>
					                  		 Total Number of Products in each Branch
					                	</h3>
					                	<div class="card-tools">
					                  		<button type="button" class="btn btn-tool" data-card-widget="collapse">
					                 			<i class="fas fa-minus"></i>
					                  		</button>
					                	</div>
					              	</div>
					              	<div class="card-body">
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
