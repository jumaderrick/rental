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

				<div class="row">
					<div class="col-sm-3"><?php require_once "includes/sidebar.php"; ?></div>
					<div class="col-sm-9">
						<div class="page-header">
							<h1 class="h-text"><span class="glyphicon glyphicon-user"></span> MANAGE EMPLOYEES</h1>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">Add Job</div>
									<div class="panel-body">

										<form action="php/parse.php" method="post" class="form-horizontal addjob">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" name="jobtitle" placeholder="Job title" id="" class="form-control">
												</div>
											</div>


											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" name="jobcode" placeholder="Job code" id="" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" name="salary" placeholder="Basic salary" id="" class="form-control">
														<div class="input-group-addon">Ksh</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" name="allowance" placeholder="Allowance" id="" class="form-control">
														<div class="input-group-addon">Ksh</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" placeholder="Enter tax rate..." name="tax" id="" class="form-control">
														<div class="input-group-addon">%</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<span class="status"></span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<button class="btn btn-info">save</button>
												</div>
											</div>
										</form>
										
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">Add & view employee</div>
									<div class="panel-body">

										<div class="btn-group">

											<a href="employees.php" class="btn btn-info">View all employees</a>

											<a href="add.php" class="btn btn-danger">Add employee</a>
											
										</div>
										
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel-heading">Manage Job profiles</div>
									<div class="panel-body">

										<table class="table">
											<thead>
												<tr>
													<th>Title</th>
													<th>Code</th>
													<th>Salary</th>
													<th>Tax</th>
													<th>Allowances</th>
													<th>Date Added</th>
													<th>delete</th>
												</tr>
											</thead>

											<tbody>

												<?php

													$db->query('SELECT * FROM jobdetails');

													foreach ($db->results() as $job) {
														?>

														
															<tr id="job_<?php echo $job->id; ?>">
																<td><a href="edit-job.php?id=<?php echo $job->id; ?>"><?php echo $job->title; ?></a></td>
																<td><?php echo $job->jobcode; ?></td>
																<td><?php echo $job->salary; ?></td>
																<td><?php echo $job->tax."%"; ?></td>
																<td><?php echo $job->allowances; ?></td>
																<td><?php echo $job->title; ?></td>
																<td><a class="deljob" jobid="<?php echo $job->id; ?>" href="">delete</a></td>
															</tr>

														<?php
													}


												?>
												
											</tbody>

										</table>
										
									</div>
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


<script>
	$(function() {
		$('.addjob').on('submit', function(event) {
			event.preventDefault();
			var formdata = new FormData($(this)[0]);
			var url = $(this).attr('action');
			var type = $(this).attr('method');

			$.ajax({
				type:type,
				url:url,
				data:formdata,
				processData:false,
				contentType:false,
				cache:false,
				complete:function() {

				},
				success:function(responseTxt) {
					if (responseTxt == 'success') {
						window.location.reload(true);
					} else {
						$('.status').html(responseTxt);
					}
				},
				error:function() {

				}
			});
		});

		$('.deljob').click(function(event) {
			event.preventDefault();
			var jobid = $(this).attr('jobid');
			var row = $("#job_"+jobid);
			
			var c = confirm('Are you sure?');

			if (c) {
				$.post('php/parse.php',{'jobdel':jobid},function(responseTxt) {
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


