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
						<h1 class="h-text"><span class="glyphicon glyphicon-user"></span> TENANT</h1>
					</div>

					<div class="panel panel-default">
						<div class="panel-body">

							<table class="table">

								<?php

									$db->query('SELECT * FROM tenant_details');

									if ($db->count()) {
										# code...
						


								?>

									<thead>
										<tr>
											<th>Tenant Number</th>
											<th>Name</th>
											<th>Telphone</th>
											<th>Gender</th>
											<th>House No</th>
											<th>Delete</th>
										</tr>
									</thead>

									<tbody>

									<?php


										foreach ($db->results() as $tenant) {
											$name = $tenant->othername." ".$tenant->surname;

											?>

												<tr id="tenant_<?php echo $tenant->id; ?>">
													<td><a href="single_tenant.php?tenantno=<?php echo $tenant->id; ?>"><?php echo $tenant->tenantno; ?></a></td>
													<td><?php echo $name; ?></td>
													<td><?php echo $tenant->telno; ?></td>
													<td><?php echo $tenant->gender; ?></td>
													<td>
														<?php
															if ($tenant->hseno === '0') {
																echo "<a href='single_tenant.php?tenantno=".$tenant->id."'>Allocate House</a>";
															} else {


																$db->query('SELECT * FROM house_details WHERE id = ?', array($tenant->hseno));
																
																if ($db->count()) {
																	$datahseno = $db->first();
																	echo "House No. ".$datahseno->houseno;
																}


															}
														?>
													</td>
													<td><button tid="<?php echo $tenant->id; ?>" class="btn btn-danger btn-xs deltenant"><span class="glyphicon glyphicon-trash"></span></button></td>
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
		$('.deltenant').click(function() {
			var tenantno = $(this).attr('tid');
			var row = $("#tenant_"+tenantno);

			var data = {'tenantnodel':tenantno};

			var c = confirm('Are you sure?');

			if (c) {
				$.post('php/parse.php',data,function(responseText) {
					if (responseText == 'success') {

						row.fadeOut();

					} else {
						alert(responseText);
					}
				});
			}

		});
	});
</script>