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

				<div class="col-sm-3"><?php require_once "includes/sidebar.php"; ?></div>
				<div class="col-sm-9">

					<div class="page-header">
						<h1 class="h-text">Employees</h1>
					</div>

					<a href="manage-employees.php">Manage Employees</a>

					<div class="panel panel-default">
						<div class="panel-body">

							<table class="table">

								<?php

									$db->query('SELECT * FROM employees');

									if ($db->count()) {
										# code...
						


								?>

									<thead>
										<tr>
											<th>Name</th>
											<th>Job Code</th>
											<th>Gender</th>
											<th>Tax Rate</th>
											<th>Salary</th>
											<th>Allowances</th>
											<th>Date of Employment</th>
											<th>Delete</th>
										</tr>
									</thead>

									<tbody>

									<?php


										foreach ($db->results() as $employee) {

											$name = $employee->othername." ".$employee->surname;

											?>

												<tr>
													<td><a href=""><?php echo $name; ?></a></td>
													<td>
														<?php

															$db->query('SELECT * FROM jobdetails WHERE id = ?',array($employee->jobcode));
															$job = $db->first();

															echo $job->title."-".$job->jobcode;


														?>
													</td>
													<td><?php echo $employee->gender === 'M' ? 'Male' : 'Female'; ?></td>
													<td><?php echo $job->tax."%"; ?></td>
													<td><?php echo $job->salary; ?></td>
													<td><?php echo $job->allowances; ?></td>
													<td><?php echo $employee->dateofemployement; ?></td>
													<td><a href="">delete</a></td>
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