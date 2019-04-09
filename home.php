<?php require_once "core/config.php"; ?>

<?php
$login = new Login();
if (!$login->isLoggedIn()) {
	header('location:login.php');
}

?>

<?php

$db = DbHelper::getInstance();


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rental</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">

	<script src="js/jquery.js"  type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>
<body>

	<div class="wrapper">

		

		<?php require_once "includes/header.php"; ?>


		<div class="content">

			<div class="container">
				<div class="col-sm-3">

					<?php require_once "includes/sidebar.php"; ?>
					
				</div>
				<div class="col-sm-9">
					<div class="page-header">
						<h1 class="h-text"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</h1>
					</div>
					<div class="row">
						<div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/13.jpg" alt="" class="img-responsive">
	                            <div class="caption">
	                                <h4 class="pull-right"></h4>
	                                <h4><a href="tenants.php">Tenants</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/3.jpg" alt="" class="img-responsive">
	                            <div class="caption">
	                                <h4 class="pull-right"></h4>
	                                <h4><a href="landlords.php">Landlords</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/21.jpg" alt="" height="164" class="img-responsive">
	                            <div class="caption">
                                  <h4 class="pull-right"></h4>
	                                <h4><a href="plots.php">Plots</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/15.jpg" alt="" class="img-responsive">
	                            <div class="caption">
	                                <h4 class="pull-right"></h4>
	                                <h4><a href="houses.php">Houses</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/18.jpg" alt="" class="img-responsive">
	                            <div class="caption">
	                                <h4 class="pull-right"></h4>
	                                <h4><a href="manage-employees.php">Employees</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-sm-4 col-sm-6 col-lg-3 col-md-3">
	                        <div class="linkbox">
	                            <img src="images/19.jpg" alt="" class="img-responsive">
	                            <div class="caption">
	                                <h4 class="pull-right"></h4>
	                                <h4><a href="set_rates.php">Set rates</a>
	                                </h4>
	                            </div>
	                        </div>
	                    </div>
					</div>
				</div>
			</div>
			
		</div>


		<?php require_once "includes/footer.php"; ?>
		
	</div>
	
</body>
</html>