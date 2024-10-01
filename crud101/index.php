<?php require_once('functions.php'); ?>
<?php require_once('_header.php'); ?>

	<div class="form-container">
		<h2>Login Form</h2>
		<?php
			// This will check if the form was submitted. 
			if(isset($_POST['login_submit'])) { 
				$username = $_POST['username'];
				$password = $_POST['password'];
 
				$response = validate_user_login($username, $password);

				if( $response == FALSE ) {
					// Therefore the username or password was invalid.
					// Reload the page and pass the login_err for the alert message
					header('Location: index.php?login_err=1');
				} else { 
					// Therefore the validation was success. 
				 	$user_id = $response;

				 	// Set up the user session data.
				 	set_user_session($user_id);

				 	// Redirect to the records' page.
				 	header('Location: records.php');
				}				
			} 

			// This will check if the login_err is set, if does display an alert message.
			if(isset($_GET['login_err'])) {
				echo '<div class="alert-message-error">Unsuccessful login.</div>';
			} 
		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
			<label class="form-input-label"> 
				<span class="form-text-label"> Username:</span> 
				<input class="form-control" type="text" name="username" value="" required autofocus >
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Password:</span> 
				<input class="form-control" type="password" name="password" value="" required > 
			</label>  
			<input class="form-button" type="submit" name="login_submit" value="LOGIN">
			<input class="form-button" type="reset" name="login_clear" value="CLEAR">
		</form>

		<p>Want to have an account click <a href="adding-form.php">REGISTER</a>.</p>
	</div>
	
<?php require_once('_footer.php'); ?>