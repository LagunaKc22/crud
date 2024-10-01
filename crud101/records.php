<?php require_once('functions.php'); ?>
<?php require_once('_header.php'); ?> 

	<div class="records-container">
		<h2>Records</h2>  
		<?php

			// This will check if the action is delete and if the user_id is set. 
			if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['user_id'])) {
				$user_id = $_GET['user_id']; 

				// Delete the specific user's record.
				delete_user($user_id);

				// Reload the page and pass the delsuccess for the alert message
				header('Location: records.php?delsuccess=1');
			}

			// This will check if the delsuccess is set, if does display an alert message.
			if(isset($_GET['delsuccess'])) {
				echo '<div class="alert-message-success">The record was successfully deleted.</div>';
			} 
		?>
		<?php
			
			$users = get_all_users();

			if(!empty($users)) {
				echo '<table class="table-records">';
				echo '<thead><tr><th>First Name</th> <th>Last Name</th> <th>Username</th> <th>Actions</th> </tr></thead>';
				echo '<tbody>';
				foreach ($users as $key => $user) {

					$edit_link = '<a href="editting-form.php?action=edit&user_id=' . $user['user_id'] . '" >Edit</a>';
					$delete_link = '<a href="records.php?action=delete&user_id=' . $user['user_id'] . '" onclick="return confirm(\'Are you sure you want to delete this record?\');">Delete</a>';

					echo '<tr>
					 		<td>' . $user['fname'] . '</td>
					 		<td>' . $user['lname'] . '</td>
					 		<td>' . $user['username'] . '</td> 
					 		<td>' . $edit_link . ' | ' . $delete_link . '</td>
					 	</tr>';
				}
				echo '</tbody>';
				echo '</table>';
			} 
		?> 
	</div>
	
<?php require_once('_footer.php'); ?>