<?php require_once "core/config.php"; ?>

<?php
$login = new Login();
if (!$login->isLoggedIn()) {
	header('location:login.php');
}

?>

<?php

$db = DbHelper::getInstance();

if(Input::is_set('landlord')) {
	$landlord = Input::get('landlord');
	$db->query('SELECT * FROM plots WHERE landlord = ?',array($landlord));
} elseif (Input::is_set('plot')) {
	$plot = Input::get('plot');
	$db->query('SELECT * FROM plots WHERE id = ?',array($plot));
}
else {
	$db->query('SELECT * FROM plots');
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
						<h1 class="h-text"><span class="glyphicon glyphicon-home"></span> PLOTS</h1>
					</div>

					<div class="panel panel-default">
						<div class="panel-body">

							<table class="table">

								<?php

									

									if ($db->count()) {
										# code...
						


								?>

									<thead>
										<tr>
											<th>Plot Number</th>
											<th>Plot Name</th>
											<th>LandLord</th>
											<th>Add House</th>
											<th>Number of Houses</th>
										</tr>
									</thead>

									<tbody>

									<?php


										foreach ($db->results() as $plot) {

											?>

												<tr>
													<td><?php echo $plot->plotnumber; ?></td>
													<td><?php echo $plot->plotname; ?></td>
													<td>
														<a href="landlords.php?landlord=<?php echo $plot->landlord; ?>">
															<?php 

															$db->query('SELECT * FROM landlord_details WHERE id = ?', array($plot->landlord));
															$d = $db->first();

															echo $d->othername;

														 	?>
														</a>
													</td>
													<td><a href="add-house.php?plot_id=<?php echo $plot->id; ?>">Add House</a></td>
													<td>

														<a href="houses.php?plot=<?php echo $plot->id; ?>">

															<?php

																$db->query('SELECT * FROM house_details WHERE plotnumber = ?', array($plot->id));
																$count = $db->count();

																echo $count." house".($count === 1 ? '' : 's');


															?>
															
														</a>
														
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
				
			</div>
		</div>


		<?php require_once "includes/footer.php"; ?>
		
	</div>
	
</body>
</html>