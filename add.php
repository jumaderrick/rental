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


	<script>

		$(function() {
			loadItems('tt');

			$('.addtabs li').click(function(event) {
				event.preventDefault();

				$('.addtabs li').removeClass('active');

				$(this).addClass('active');

				var index = $(this).parent().children().index(this);

				var pages = ['tt','ll','pt','ee'];

				loadItems(pages[index]);
			});
		});

		function loadItems(item) {
			var box = $('.page-content');
			var title = $('.page-title');
			switch(item) {
				case '':
				break;
				case 'll':
				title.text('Add Landlord');
				$.get('ajax/add_landlord.php',function(responseTxt) {
					box.html(responseTxt);
				});
				break;
				case 'tt':
				title.text('add Tenant');
				$.get('ajax/add_tenant.php',function(responseTxt) {
					box.html(responseTxt);
				});
				break;
				case 'pt':
				title.text('Add Plot');
				$.get('ajax/add_plot.php',function(responseTxt) {
					box.html(responseTxt);
				});
				break;
				case 'ee':
				title.text('Add Employee');
				$.get('ajax/add_employee.php',function(responseTxt) {
					box.html(responseTxt);
				});
				break;
			}
		}


	</script>


</head>
<body>

	<div class="wrapper">

		

		<?php require_once "includes/header.php"; ?>


		<div class="content">
			<div class="container">
				<div class="row">
					<div class="col-sm-3">

						<?php require_once "includes/sidebar.php"; ?>

					</div>
					<div class="col-sm-9">

						<ul class="nav nav-tabs addtabs">
							<li class="active"><a href="">Add Tenant</a></li>
							<li><a href="">Add Landlord</a></li>
							<li><a href="">Add Plot</a></li>
							<li><a href="">Add Employee</a></li>
						</ul>

						<h1 class="h-text padding page-title">ADD Tenant</h1>


						<div class="page-content"></div>
						
					</div>
				</div>
			</div>
		</div>


		<?php require_once "includes/footer.php"; ?>
		
	</div>
	
</body>
</html>