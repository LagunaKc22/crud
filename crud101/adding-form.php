<?php require_once('functions.php'); ?>
<?php require_once('_header.php'); ?>

	<div class="form-container">
		<h2>Registration Form</h2>
		<?php
			// This is to check if the form was submitted. 
			if(isset($_POST['register_submit'])) {
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$username = $_POST['username'];
				$password = $_POST['password'];

				// Save the user data.
				save_user($fname, $lname, $username, $password);

				// Reload the page and pass the regsuccess for the alert message
				header('Location: adding-form.php?regsuccess=1');
			}

			// This will check if the regsuccess is set, if does display an alert message.
			if(isset($_GET['regsuccess'])) {
				echo '<div class="alert-message-success">You registration was successfully save.</div>';
			}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label class="form-input-label"> 
				<span class="form-text-label"> First Name:</span> 
				<input class="form-control" type="text" name="fname" value="" required autofocus > 
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Last Name:</span> 
				<input class="form-control" type="text" name="lname" value="" required > 
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Username:</span> 
				<input class="form-control" type="text" name="username" value="" required >
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Password:</span> 
				<input class="form-control" type="password" name="password" value="" required > 
			</label>  
			<input class="form-button" type="submit" name="register_submit" value="REGISTER">
			<input class="form-button" type="reset" name="register_clear" value="CLEAR">
		</form>

		<p>Already have an account click <a href="index.php">LOGIN</a>.</p>
	</div>
	
<?php require_once('_footer.php'); ?>