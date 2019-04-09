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
							<h1 class="h-text"><span class="glyphicon glyphicon-home"></span> SET DEDUCTIONS</h1>
						</div>

						<div class="row">

							<div class="col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">Current Rates</div>
									<div class="panel-body">


										 

											<?php

												$db->query('SELECT * FROM rates WHERE active = ?', array('1'));
												$rate = $db->first();

												echo '<strong class="text-info"><i>Fee:</i>'.$rate->rate.'%</strong></br>';
												echo '<strong class="text-info"><i>Tax:</i>'.$rate->tax.'%</strong>';

											?>

										

										<hr>

										<table class="table">
											<thead>
												<tr>
													<th>choose</th>
													<th>Fee</th>
													<th>Tax</th>
													<th>Date registered</th>
													<th>Delete</th>
												</tr>
											</thead>

											<tbody>

												<?php

													$db->query('SELECT * FROM rates');

													foreach ($db->results() as $rate) {
														?>


															<tr id="rates_<?php echo $rate->id; ?>">
																<td>
																	<?php

																		if ($rate->active === '1') {
																			echo '<button rid="'.$rate->id.'" class="btn btn-xs btn-danger setratebtn">Active</button>';
																		} else {
																			echo '<button rid="'.$rate->id.'" class="btn btn-xs btn-default setratebtn">choose</button>';
																		}

																	?>
																	
																</td>
																<td><?php echo $rate->rate; ?></td>
																<td><?php echo $rate->tax; ?></td>
																<td><?php echo TimeProcessor::getTime($rate->createdAt); ?></td>
																<td><a class="delrates" rid="<?php echo $rate->id; ?>" href="">delete</a></td>
															</tr>



														<?php
													}


												?>
												
											</tbody>

										</table>

										
										
									</div>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="panel panel-default">
									<div class="panel-heading">Update rates</div>
									<div class="panel-body">

										<form action="php/parse.php" method="post" class="form-horizontal setrates">
											<div class="form-group">
												<div class="col-md-12">
													<div class="input-group">
														<input type="text" placeholder="Enter fee rate..." name="rate" id="" class="form-control">
														<div class="input-group-addon">%</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<div class="input-group">
														<input type="text" placeholder="Enter tax rate..." name="tax" id="" class="form-control">
														<div class="input-group-addon">%</div>
													</div>
												</div>
											</div>
											<div class="form-group">
												<div class="col-md-12">
													<p class="status"></p>
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
		$('.setrates').on('submit', function(event) {
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
					$('.status').html(responseTxt);
				},
				error:function() {

				}
			});
		});
	});

	$('.delrates').click(function(event) {
		event.preventDefault();
		var rid = $(this).attr('rid');
		var row = $("#rates_"+rid);
		
		var c = confirm('Are you sure?');

		if (c) {
			$.post('php/parse.php',{'ratedel':rid},function(responseTxt) {
				if (responseTxt == 'success') {
					row.fadeOut();
				} else {
					alert(responseTxt);
				}
			});
		}

	});

	$('.setratebtn').click(function() {
		var rid = $(this).attr('rid');
		var selected = this;
		$.post('php/parse.php',{'ratechange':rid},function(responseTxt) {
			if (responseTxt == 'success') {
				window.location.reload(true);
			} else {
				alert(responseTxt);
			}
		});

	});

</script>