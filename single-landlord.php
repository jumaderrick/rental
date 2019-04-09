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

if (Input::is_set('landlordno')) {

	$landlordno = Input::get('landlordno');
	$db->query('SELECT * FROM landlord_details WHERE id = ?', array($landlordno));
	$data = $db->first();
	$name = $data->othername." ".$data->surname;
	$names = explode(" ", $data->othername);

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

				<div class="col-sm-3">

					<?php require_once "includes/sidebar.php"; ?>
					
				</div>
				<div class="col-sm-9">
					<h1 class="h-text padding"><?php echo $name; ?></h1>

					<div class="page-header">
						<h1 class="h-text">PERSONAL DETAILS</h1>
					</div>

					<div class="row">
						<div class="col-sm-6">


							<div class="panel panel-default">
								<div class="panel-heading">Personal Details</div>
								<div class="panel-body">
									<table class="table">
										<tbody>

											<tr>
												<td>Landlord Number:</td>
												<td><?php echo $data->landlordno; ?></td>
											</tr>

											<tr>
												<td>Tenant Name:</td>
												<td><?php echo $name; ?></td>
											</tr>

											<tr>
												<td>Gender:</td>
												<td><?php echo $data->gender === 'M' ? 'Male' : 'Female'; ?></td>
											</tr>

											<tr>
												<td>Telphone:</td>
												<td><?php echo $data->telno; ?></td>
											</tr>

											<tr>
												<td>Reg. Date:</td>
												<td><?php //echo TimeProcessor::getTime($data->createdAt); ?></td>
											</tr>

											
										</tbody>
									</table>
								</div>
							</div>
							
						</div>
						<div class="col-sm-6">


							<div class="panel panel-default">
								<div class="panel-heading">Edit Personal Details</div>
								<div class="panel-body">

									<form action="php/parse.php" method="post" class="form-horizontal edittenant">
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" value="<?php echo $data->telno; ?>" name="nltelno" placeholder="Telephone Number" id="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<select name="gender" id="" class="form-control">
													<option value="">Gender</option>
													<option value="M">Male</option>
													<option value="F">Female</option>
												</select>
											</div>
										</div>

										<input type="hidden" value="<?php echo $landlordno; ?>" name="landldno">

										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="nlsurname" value="<?php echo $data->surname; ?>" placeholder="Surname" id="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="nlfname" value="<?php echo $names[0]; ?>" placeholder="First Name" id="" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="nllname" value="<?php echo $names[1]; ?>" placeholder="Last Name" id="" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<span class="status"></span>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<button class="btn btn-info">update data</button>
											</div>
										</div>
											
									</form>
									
								</div>
							</div>
							
						</div>
					</div>

					<div class="page-header">
						<h1 class="h-text"><?php echo $names[0]."'s"; ?> Plots</h1>
					</div>

					<div class="row">
						<div class="col-sm-6">

							<div class="panel panel-default">
								<div class="panel-heading">Plots</div>
								<div class="panel-body">
									<ul class="sidebar-links">
										<?php

											$db->query('SELECT * FROM plots WHERE landlord = ?',array($landlordno));

											foreach ($db->results() as $plot) {
												?>


													<li><a href=""><?php echo $plot->plotname."-".$plot->plotnumber; ?></a></li>


												<?php
											}


										?>
									</ul>
								</div>
							</div>
							
						</div>

						<div class="col-sm-6">

							<div class="panel panel-default">
								<div class="panel-heading">Disbursed Amount this Month</div>
								<div class="panel-body">

									<?php

										$current_month_year = TimeProcessor::getYearMonth(time());
										$total_amount = 0;


										$db->query('SELECT * FROM landlord_disbursement WHERE landlordno = ?',array($landlordno));

											foreach ($db->results() as $dis) {

												$dateMonth = TimeProcessor::getYearMonth($dis->disdate);
												$amount = $dis->amount;

												if ($dateMonth === $current_month_year) {
													$total_amount += $amount;
												}
											
											}

									?>

									<strong class="text-info"><i>Amount: Ksh. </i> <?php echo $total_amount; ?></strong>
									
								</div>
							</div>
							
						</div>
					</div>

					<div class="page-header">
						<h1 class="h-text">Disbursement Report</h1>
					</div>

					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">Disbursement Report</div>
								<div class="panel-body">


									<table class="table">
										<thead>
											<tr>
												<th>Transtaction</th>
												<th>Tenant</th>
												<th>Plot</th>
												<th>House</th>
												<th>Amount</th>
												<th>Deductions</th>
												<th>Tax</th>
												<th>Date</th>
												<th>Print</th>
											</tr>
										</thead>

										<tbody>


											<?php

												$db->query('SELECT * FROM landlord_disbursement WHERE landlordno = ?',array($landlordno));

												foreach ($db->results() as $dis) {
													?>


														<tr>
															<td><?php echo $dis->transaction; ?></td>
															<td>
																<a href="single_tenant.php?tenantno=<?php echo $dis->tenantno; ?>">
																	<?php 

																		$db->query('SELECT * FROM tenant_details WHERE id = ?', array($dis->tenantno));
																		$data = $db->first();
																		$name = $data->othername." ".$data->surname;
																		echo $name;

																	 ?>
																</a>
															</td>
															<td>
																<a href="">
																	<?php 

																		$db->query('SELECT * FROM plots WHERE id = ?',array($dis->plotno));
																		$plot = $db->first();

																		echo $plot->plotname."-".$plot->plotnumber;

																	 ?>
																</a>
															</td>
															<td>
																
																	<?php 

																		$db->query('SELECT * FROM house_details WHERE id = ?',array($dis->hseno));
																		$house = $db->first();

																		echo $house->houseno;

																	 ?>
																
															</td>
															<td><?php echo $dis->amount; ?></td>
															<td>

																<?php


																	echo $dis->deduct;


																?>
																
															</td>
															<td>

																<?php


																	echo $dis->tax;


																?>
																
															</td>
															<td><?php echo TimeProcessor::getTime($dis->disdate); ?></td>
															<td><a href="print.php?id=<?php echo $dis->id; ?>">print</a></td>
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


		<?php require_once "includes/footer.php"; ?>
		
	</div>
	
</body>
</html>


<script>
	$(function() {
		$('.edittenant').on('submit', function(event) {
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
	});

</script>