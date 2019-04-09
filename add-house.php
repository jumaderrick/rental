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

$plotname = "";
$plot_no = null;
$plotnumber = null;



if (Input::is_set('plot_id')) {
	$plot_no = Input::get('plot_id');

	$db->query('SELECT * FROM plots WHERE id = ?', array($plot_no));
	$data = $db->first();

	$plotname = $data->plotname;
	$plotnumber = $data->id;
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
							<h1 class="h-text">Add House <?php echo $plotname; ?></h1>
						</div>

						<form action="php/parse.php" method="post" class="form-horizontal add-house">
							<?php

								if (!Input::is_set('plot_id')) {

							?>
							<div class="form-group">
								<div class="col-md-12">
									<select name="plotnumber" id="" class="form-control">
										<option value="">select plot</option>
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

							<?php 

								} 

								else {
									?>
										
										<input type="hidden" name="plotnumber" value="<?php echo $plotnumber; ?>">

									<?php
								}

							?>
							<div class="form-group">
								<div class="col-md-12">
									<input type="text" name="rent" id="" placeholder="rent" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<input type="text" name="hseno" id="" placeholder="House Number" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<p class="status"></p>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-12">
									<button class="btn btn-info">SAVE</button>
								</div>
							</div>
						</form>


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
		$('.add-house').on('submit', function(event) {
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
						window.location = "houses.php";
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