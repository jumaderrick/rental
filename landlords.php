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
	$db->query('SELECT * FROM landlord_details WHERE id = ?',array($landlord));
} else {
	$db->query('SELECT * FROM landlord_details');
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
						<h1 class="h-text"><span class="glyphicon glyphicon-user"></span> LANDLORDS</h1>
					</div>

					<div class="panel panel-default">
						<div class="panel-body">

							<table class="table">

								<?php

									

									if ($db->count()) {
										
						


								?>

									<thead>
										<tr>
											<th>Landlord Number</th>
											<th>Name</th>
											<th>Telphone</th>
											<th>Gender</th>
											<th>Plots</th>
											<th>Delete</th>
										</tr>
									</thead>

									<tbody>

									<?php


										foreach ($db->results() as $land) {

											$name = $land->othername." ".$land->surname;

											?>

												<tr id="landlords_<?php echo $land->id; ?>">
													<td><a href="single-landlord.php?landlordno=<?php echo $land->id; ?>"><?php echo $land->landlordno; ?></a></td>
													<td><?php echo $name; ?></td>
													<td><?php echo $land->telno; ?></td>
													<td><?php echo $land->gender; ?></td>
													<td>

														<a href="plots.php?landlord=<?php echo $land->id; ?>">

															<?php

																$db->query('SELECT * FROM plots WHERE landlord = ?', array($land->id));
																$count = $db->count();

																echo $count." ".($count === 1 ? 'plot' : 'plots');


															?>
															
														</a>
														
													</td>
													<td><a class="delland" landid="<?php echo $land->id; ?>" href="">delete</a></td>
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


<script>
	$(function() {
		$('.delland').click(function(event) {
			event.preventDefault();
			var landid = $(this).attr('landid');
			var row = $("#landlords_"+landid);
			
			var c = confirm('Are you sure?');

			if (c) {
				$.post('php/parse.php',{'delland':landid},function(responseTxt) {
					if (responseTxt == 'success') {
						row.fadeOut();
					} else {
						alert(responseTxt);
					}
				});
			}

		});
	});
</script>