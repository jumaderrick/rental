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

<?php

if (Input::is_set('id')) {
	
	$id = Input::get('id');
	$db->query("SELECT * FROM jobdetails WHERE id = ?",array($id));
	$job = $db->first();
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

				<div class="row">
					<div class="col-sm-3"><?php require_once "includes/sidebar.php"; ?></div>
					<div class="col-sm-9">
						<div class="page-header">
							<h1 class="h-text"><span class="glyphicon glyphicon-home"></span> EDIT JOB</h1>

						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">Edit Job profile</div>
									<div class="panel-body">

										<form action="php/parse.php" method="post" class="form-horizontal addjob">
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" value="<?php echo $job->title; ?>" name="newjobtitle" placeholder="Job title" id="" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
													<input type="text" value="<?php echo $job->jobcode; ?>" name="jobcode" placeholder="Job code" id="" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" value="<?php echo $job->salary; ?>" name="salary" placeholder="Basic salary" id="" class="form-control">
														<div class="input-group-addon">Ksh</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" value="<?php echo $job->allowances; ?>" name="allowance" placeholder="Allowance" id="" class="form-control">
														<div class="input-group-addon">Ksh</div>
													</div>
												</div>
											</div>

											<div class="form-group">
												<div class="col-sm-12">
													<div class="input-group">
														<input type="text" value="<?php echo $job->tax; ?>" placeholder="Enter tax rate..." name="tax" id="" class="form-control">
														<div class="input-group-addon">%</div>
													</div>
												</div>
											</div>

											<input type="hidden" value="<?php echo $job->id; ?>" name="jobupdate">

											<div class="form-group">
												<div class="col-md-12">
													<span class="status"></span>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<button class="btn btn-info">update</button>
												</div>
											</div>
										</form>
										
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
						window.location = "manage-employees.php";
					} else {
						$('.status').html(responseTxt);
					}
				},
				error:function() {

				}
			});
		});
	});

</script>