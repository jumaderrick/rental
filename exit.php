<?php require_once "core/config.php"; ?>
<?php
$login = new Login();
if ($login->isLoggedIn()) {
	$login->logout();
	header('location:login.php');
}

?>