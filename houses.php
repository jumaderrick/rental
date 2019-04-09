<?php require_once "core/config.php"; ?>

<?php
$login = new Login();
if (!$login->isLoggedIn()) {
	header('location:login.php');
}

?>

<?php

$db = DbHelper::getInstance();

if(Input::is_set('plot')) {
	$plot = Input::get('plot');
	$db->query('SELECT * FROM house_details WHERE plotnumber = ?',array($plot));
} else {
	$db->query('SELECT * FROM house_details');
}




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

				<div class="col-sm-3"><?php require_once "includes/sidebar.php"; ?></div>
				<div class="col-sm-9">

					<div class="page-header">
						<h1 class="h-text"><span class="glyphicon glyphicon-home"></span> HOUSES</h1>
					</div>

					<table class="table-hover table-responsive table-items table-bordered">

						<?php

							

							if ($db->count()) {
								# code...
				


						?>

							<thead>
								<tr>
									<td>House Number</td>
									<td>Plot Name</td>
									<td>LandLord</td>
									<td>Rent per Month(KSh.)</td>
									<td>Occupied</td>
								</tr>
							</thead>

							<tbody>

							<?php


								foreach ($db->results() as $house) {

									?>

										<tr>
											<td><a href="edit-house.php?houseno=<?php echo $house->id; ?>"><?php echo $house->houseno; ?></a></td>
											<td>

												<a href="plots.php?plot=<?php echo $house->plotnumber; ?>">

													<?php

														$db->query('SELECT * FROM plots WHERE id = ?', array($house->plotnumber));
														$data = $db->first();
														$landlord = $data->landlord;

														echo $data->plotname;


													?>
													
												</a>
												
											</td>
											
											<td>

												<a href="landlords.php?landlord=<?php echo $landlord; ?>">

													<?php

														$db->query('SELECT * FROM landlord_details WHERE id = ?', array($landlord));
														$dataland = $db->first();

														echo $dataland->othername;


													?>
													
												</a>
												
											</td>

											<td><?php echo $house->rent; ?></td>
											<td>

												<?php

													if ($house->occupied === '1') {

														echo '<a href="single_tenant.php?tenantno='.$house->tenant.'">Yes</a>';
														
													} else {
														echo "No";
													}


												?>
												
											</td>

										</tr>


									<?php
								}



							?>
							
							</tbody>

							<?php } 

								else {


								}

							?>
						
					</table>
				</div>
				
			</div>
		</div>


		<?php require_once "includes/footer.php"; ?>
		
	</div>
	
</body>
</html>