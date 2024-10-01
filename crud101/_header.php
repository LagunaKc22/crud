<!DOCTYPE html>
<html>
<head>
	<title>Mini System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="wrapper">
		<h1>Mini System</h1>
		<hr>
		<?php 
			if(isset($_SESSION['logged_in'])) {
				echo '<p class="move-right">Hi! ' . $_SESSION['fname'] . ' ' . $_SESSION['lname'] . '. <a href="logout.php">Logout</a></p>';
			}
		?>

		