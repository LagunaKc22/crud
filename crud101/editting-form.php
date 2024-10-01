<?php require_once('functions.php'); ?>
<?php require_once('_header.php'); ?> 

	<div class="form-container">
		<h2>Editting Form</h2>
		<?php 

			// This will check if the action is edit and if the user_id is set.
			// if does, we are going to retrieve the user's data to be display in the form.
			if(isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['user_id'])) { 
				$user_id = $_GET['user_id'];  
				$user = get_user($user_id); 
			}

			// This is to check if the form was submitted. 
			if(isset($_POST['edit_submit'])) {

				$user_id = $_POST['user_id'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$username = $_POST['username']; 

				// Update the user data.
				update_user($user_id, $fname, $lname, $username); 

				// Reload the page and pass the editsuccess for the alert message
				header('Location: editting-form.php?action=edit&user_id=' . $user_id . '&editsuccess=1');
			}

			// This will check if the editsuccess is set, if does display an alert message.
			if(isset($_GET['editsuccess'])) {
				echo '<div class="alert-message-success">The record has been successfully updated.</div>';
			}

		?>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			<label class="form-input-label"> 
				<span class="form-text-label"> First Name:</span> 
				<input class="form-control" type="text" name="fname" value="<?php if(isset($user['fname'])) echo $user['fname']; ?>" required autofocus > 
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Last Name:</span> 
				<input class="form-control" type="text" name="lname" value="<?php if(isset($user['lname'])) echo $user['lname']; ?>" required > 
			</label>
			<label class="form-input-label"> 
				<span class="form-text-label"> Username:</span> 
				<input class="form-control" type="text" name="username" value="<?php if(isset($user['username'])) echo $user['username']; ?>" required >
			</label>  

			<input type="hidden" name="user_id" value="<?php if(isset($user['user_id'])) echo $user['user_id']; ?>" >

			<input class="form-button" type="submit" name="edit_submit" value="UPDATE">
			<a href="records.php"><button type="button" class="form-button" >BACK</button></a>
		</form>
	</div>
	
<?php require_once('_footer.php'); ?>