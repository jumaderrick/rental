<?php require_once "core/config.php"; ?>

<?php
$hserent = false;

$login = new Login();
if (!$login->isLoggedIn()) {
	header('location:login.php');
}

?>

<?php

$db = DbHelper::getInstance();


?>

<?php

if (Input::is_set('tenantno')) {

	$tenantno = Input::get('tenantno');
	$db->query('SELECT * FROM tenant_details WHERE id = ?', array($tenantno));
	$data = $db->first();
	$name = $data->othername." ".$data->surname;
	$names = explode(" ", $data->othername);
	$hseAllocDate = $data->hseAllocDate;
	$hseno = $data->hseno;

	$db->query("SELECT * FROM house_details WHERE id = ?", array($hseno));
	
	if ($db->count()) {
		$rent = $db->first();

		$hserent = $rent->rent;
	}


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
												<td>Tenant Number:</td>
												<td><?php echo $data->tenantno; ?></td>
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
												<td><?php echo TimeProcessor::getTime($data->createdAt); ?></td>
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
												<input type="text" value="<?php echo $data->telno; ?>" name="nttelno" placeholder="Telephone Number" id="" class="form-control">
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

										<input type="hidden" value="<?php echo $tenantno; ?>" name="ntenantno">

										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="ntsurname" value="<?php echo $data->surname; ?>" placeholder="Surname" id="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="ntfname" value="<?php echo $names[0]; ?>" placeholder="First Name" id="" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<input type="text" name="ntlname" value="<?php echo $names[1]; ?>" placeholder="Last Name" id="" class="form-control">
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<span class="status"></span>
											</div>
										</div>

										<div class="form-group">
											<div class="col-sm-12">
												<button class="btn btn-info">Update Tenant Info</button>
											</div>
										</div>
											
									</form>
									
								</div>
							</div>
							
						</div>
					</div>

					<div class="page-header">
						<h1 class="h-text">HOUSE DETAILS</h1>
					</div>

					<div class="row">
						<div class="col-sm-6">

							<div class="panel panel-default">
								<div class="panel-heading">House Details</div>
								<div class="panel-body">
									<table class="table">
										<tbody>

											<tr>
												<td>Plot:</td>
												<td><?php 
												$db->query('SELECT * FROM plots WHERE id = ?', array($data->plotno));
												if ($db->count()) {
													$dataplot = $db->first();
													echo $dataplot->plotname."-".$dataplot->plotnumber;
												}
											?></td>
											</tr>

											<tr>
												<td>House:</td>
												<td><?php 

												$db->query('SELECT * FROM house_details WHERE id = ?', array($data->hseno));
												
												if ($db->count()) {
													$datahseno = $db->first();
													echo "House No. ".$datahseno->houseno;
												}

											 ?></td>
											</tr>

											<tr>
												<td>Date Alloc.:</td>
												<td><?php echo TimeProcessor::getTime($data->hseAllocDate); ?></td>
											</tr>


											
										</tbody>
									</table>
								</div>
							</div>
							
						</div>

						<div class="col-sm-6">

							<div class="panel panel-default">
								<div class="panel-heading">Edit House Details</div>
								<div class="panel-body">
									<form action="php/parse.php" method="post" class="form-horizontal savetenanthouse">

										<div class="form-group">
											<div class="col-sm-12">
												<input type="hidden" name="tenantid" value="<?php echo $tenantno; ?>">
												<select name="plotno" id="" class="form-control plotsselect">
													<option value="">Select plot</option>
													<?php
														$db->query('SELECT * FROM plots');

														foreach ($db->results() as $land) {

																?>

																	<option value="<?php echo $land->id; ?>"><?php echo $land->plotname; ?></option>


																<?php
															}
													?>
												</select>
											</div>
										</div>

										<div class="form-group housesel" style="display:none">
											<div class="col-sm-12">
												<select name="houseno" id="" class="form-control housesavailable">
												</select>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<span class="statush"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-12">
												<button class="btn btn-info">update</button>
											</div>
										</div>
					
									</form>
								</div>
							</div>
							
						</div>
					</div>

					<div class="page-header">
						<h1 class="h-text">PAY RENT</h1>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="panel panel-default">
								<div class="panel-heading">Pay Rent</div>
								<div class="panel-body">

									<form action="php/parse.php" method="post" class="form-horizontal payrent">
										<div class="form-group">
											<div class="col-md-12">
												<input type="text" name="amount" placeholder="Enter amount" id="" class="form-control">
											</div>
										</div>
										<input type="hidden" name="tenantpayno" value="<?php echo $tenantno; ?>">
										<div class="form-group">
											<div class="col-md-12">
												<span class="statusp"></span>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-12">
												<button class="btn btn-info">pay</button>
											</div>
										</div>
									</form>
									
								</div>
							</div>
						</div>
						<div class="col-sm-6">

							<div class="panel panel-default">
								<div class="panel-heading">More details</div>
								<div class="panel-body">

									<table class="table">

										<tr>
											<td>Rent Advance</td>
											<td>
												<?php

												$rentbal = 0;
												$fine = 0;
												$rentadvance = 0;


												if ($hserent) {
													$db->query("SELECT * FROM rent_details WHERE tenant_no",array($tenantno));
													$rentdetails = $db->first();
													$datepaid = $rentdetails->datepaid;

													$daterent = $hseAllocDate;
													$totalrentpaid = 0;

													$diff = $datepaid - $daterent;

													$months = (int) ceil($diff/(30*24*60*60));

													foreach ($db->results() as $rent) {
														$totalrentpaid += $rent->rent_paid;
													}

													$rentToBePaid = 0;

													if ($months > 0) {
														for ($i=0; $i < $months; $i++) { 
															$rentToBePaid += $hserent;
														}
													}

													$rentbal =  $rentToBePaid - $totalrentpaid;
													$rentadvance = 0;
													$fine = 0;

													if ($rentbal < 0) {
														$rentadvance = $totalrentpaid - $rentToBePaid;
														$rentbal = 0;
													}

													

													if ($rentbal > 0) {
														$datetoday = getdate();
														$day = $datetoday['mday'];

														if ($day > 15) {
															$fine = (5/100) * $hserent;
															$fine = round($fine);
														}
													}
												}

												echo "KSh. ".$rentadvance;

												?>
											</td>
										</tr>

										<tr>
											<td>Rent Balance</td>
											<td><?php echo "KSh. ".$rentbal; ?></td>
										</tr>

										<tr>
											<td>Rent Fine</td>
											<td><?php echo "KSh. ".$fine; ?></td>
										</tr>
										
									</table>

									
								</div>
							</div>
							
						</div>
					</div>

					<div class="page-header">
						<h1 class="h-text">Payment Report</h1>

					</div>

					<div class="row">

						<div class="col-sm-12">
							<div class="panel panel-default">
								<div class="panel-heading">Payment report</div>
								<div class="panel-body">

									<table class="table">
										<thead>
											<tr>

												<th>Transaction</th>
												<th>Date</th>
												<th>Amount(KSh)</th>
												<th>Plot</th>
												<th>House</th>
												<th>Delete</th>
												
											</tr>
										</thead>

										<tbody>

											<?php


												$db->query('SELECT * FROM rent_details WHERE tenant_no = ?',array($tenantno));

												foreach ($db->results() as $rent) {
													?>


														<tr>

															<td><?php echo $rent->transaction; ?></td>
															<td><?php echo TimeProcessor::getTime($rent->datepaid); ?></td>
															<td><?php echo $rent->rent_paid; ?></td>
															<td>
																<a href="">
																	<?php 

																		$db->query('SELECT * FROM plots WHERE id = ?',array($rent->plotno));
																		$plot = $db->first();

																		echo $plot->plotname."-".$plot->plotnumber;

																	 ?>
																</a>
															</td>
															<td>
																<a href="">
																	<?php 

																		$db->query('SELECT * FROM house_details WHERE id = ?',array($rent->houseno));
																		$house = $db->first();

																		echo $house->houseno;

																	 ?>
																</a>
															</td>
															<td><a href="reciept.php?id=<?php echo $rent->id; ?>">print</a></td>
															
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

		$('.payrent').on('submit', function(event) {
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
					$('.statusp').html(responseTxt);
				},
				error:function() {

				}
			});
		});

		$('.savetenanthouse').on('submit', function(event) {
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
					$('.statush').html(responseTxt);
				},
				error:function() {

				}
			});
		});

		$('.plotsselect').on('change', function() {
			var value = $(this).val();
			$('.housesavailable').empty();
			$.post('php/parse.php',{'plot_id':value}, function(data) {
				$('.housesel').fadeIn();
				$('.housesavailable').html(data);
			});
		});

	});
</script>