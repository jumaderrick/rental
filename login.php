<?php require_once "core/config.php"; ?>

<?php

$login = new Login();

if ($login->isLoggedIn()) {
	header('location:home.php');
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Rental</title>

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<script src="js/jquery.js"  type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

	<style>
		body {
			background: url('images/banner.jpg');
			background-size: cover;
			background-position: center;
			background-attachment: fixed;
		}

		.wrapper {
			width: 100%;
			height: 100%;
			position: fixed;
			top: 0;
			left: 0;
			background: rgba(0,0,0,0.8);
		}

		.box {
			background: #fff;
			width: 40%;
			padding: 15px;
			position: fixed;
			top: 20%;
			left: 30%;
			z-index: 999;
			border-radius: 10px;
		}


		h1, p {
			margin: 0;
		}

		h1 {
			color: #E91E63;
			font-weight: bolder;
			font-size: 25px;
			padding-bottom: 15px;
		}


	</style>

	<script>
		$(function() {
			$('.loginform').on('submit', function(event) {
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
							window.location = "home.php";
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

</head>
<body>

	<div class="wrapper"></div>

	<div class="box">

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="padding">Login</h1>
					<form action="php/parse.php" method="post" class="form-horizontal padding loginform">
						<div class="form-group">
							<div class="col-md-12">
								<input type="text" placeholder="Username" name="username" id="" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="password" name="password" placeholder="password..." id="" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label for="" class="checkbox-inline">
									<input type="checkbox" name="remember" value="yes" id=""> Remember Me</label>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<p class="status"></p>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<button class="btn btn-info">LOGIN</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
	
</body>
</html>