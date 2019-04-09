<?php require_once "core/config.php"; ?>

<?php

$login = new Login();

if ($login->isLoggedIn()) {
	header('location:home.php');
}

if (Session::exists('firstload')) {
	header('location:login.php');
} else {
	Session::put('firstload','firstload');
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
			width: 50%;
			padding: 15px;
			position: fixed;
			top: 40%;
			left: 25%;
			z-index: 999;
			border-radius: 10px;
		}

		.title {
			background: #fff;
			width: 50%;
			padding: 15px;
			position: fixed;
			top: 10%;
			left: 25%;
			z-index: 999;
			border-radius: 10px;
		}

		.progress {
			margin: 0;
		}

		h1, p {
			margin: 0;
		}

		h1 {
			color: #E91E63;
			font-weight: bolder;
			font-size: 25px;
		}


	</style>

	<script>

		$(function() {

			loading(0);

		});

		function loading(percent) {

			 $('.loadtext').text(percent+"% Complete");
			 
			 $('.progress-bar').width(percent+"%");

			 if (percent == 100) {
			 	percent = 0;
			 	clearTimeout(timer);
			 	window.location = "login.php";
			 };

			 percent ++;

			 

			 var timer = setTimeout('loading('+percent+')',100);
		}

	</script>

</head>
<body>

	<div class="wrapper"></div>


	

	<div class="box">

		<div class="progress">
		  <div class="progress-bar progress-bar-danger progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width:0%">
		    <span class="loadtext">45% Complete</span>
		  </div>
		</div>
		
	</div>

	
	
</body>
</html>