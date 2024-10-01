<?php

//$stmt->num_rows
start_session();

/**
 *	This will manage to start the session.
 */
function start_session() { 
	if(!session_id()) {
		session_start();
	} 
}


/**
 *	This will manage to set up data user session, which we use once we logged in.
 */
function set_user_session($user_id) {

	$user = get_user($user_id);

	if($user != FALSE) {
		$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['username'] = $user['username'];
		$_SESSION['fname'] = $user['fname'];
		$_SESSION['lname'] = $user['lname'];
		$_SESSION['logged_in'] = TRUE;
	}
}


/**
 *	This will manage to clear user session, which we use once we logged out.
 */
function clear_user_session() {
	session_destroy();
}



/**
 *	This will manage to set up the database connection.
 */
function dbconnection() {

	$host = 'localhost';
	$dbname = 'minisystem';
	$user = 'root';
	$pass = '';
	$dsn = "mysql:host=$host;dbname=$dbname";

	try { 
	    return new PDO($dsn, $user, $pass);
	} catch (PDOException $e) {
	    print "Error!: " . $e->getMessage() . "<br/>";
	    die();
	}

}



/**
 *	This will manage to save the user data to the database.
 */
function save_user($fname, $lname, $username, $password) {

	$hash_password = md5($password);

	$conn = dbconnection();

	$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
	$response = $stmt->execute(array(':username' => $username, ':password' => $hash_password));

	if( $response ) { 
		$user_id = $conn->lastInsertId();
		$stmt = $conn->prepare("INSERT INTO profile (user_id, fname, lname) VALUES (:user_id, :fname, :lname)");
		$response = $stmt->execute(array(':user_id' => $user_id, ':fname' => $fname, ':lname' => $lname ));
	}
	 
}



/**
 *	This will manage to update the user data from the database.
 */
function update_user($user_id, $fname, $lname, $username) {

	$conn = dbconnection();

	$stmt = $conn->prepare("UPDATE users SET username = :username WHERE user_id = :user_id");
	$stmt->execute(array(':username' => $username, ':user_id' => $user_id ));

	$stmt = $conn->prepare("UPDATE profile SET fname = :fname, lname = :lname WHERE user_id = :user_id");
	$stmt->execute(array(':fname' => $fname, ':lname' => $lname, ':user_id' => $user_id ));
 
}


/**
 *	This will manage to delete the user related data from the database.
 */
function delete_user($user_id) {

	$conn = dbconnection();

	$stmt = $conn->prepare("DELETE FROM users WHERE user_id = :user_id");
	$stmt->execute(array(':user_id' => $user_id ));

	$stmt = $conn->prepare("DELETE FROM profile WHERE user_id = :user_id");
	$stmt->execute(array(':user_id' => $user_id ));

 }



/**
 *	This will manage to retrieve a single user's record from the database.
 */
function get_user($user_id) {

	$conn = dbconnection(); 

	$stmt = $conn->prepare("SELECT u.user_id, u.username, p.fname, p.lname FROM users u JOIN profile p ON u.user_id = p.user_id  WHERE u.user_id = :user_id");
	$stmt->execute(array(':user_id' => $user_id));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	return $result;
}



/**
 *	This will manage to retrieve all the users' record from the database.
 */
function get_all_users() {
 
	$conn = dbconnection(); 

	$stmt = $conn->prepare("SELECT u.user_id, u.username, p.fname, p.lname FROM users u JOIN profile p ON u.user_id = p.user_id");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;
}



/**
 *	This will manage to validate the user's credentials to the database.
 */
function validate_user_login($username, $password) {

	$hash_password = md5($password);

	$conn = dbconnection(); 

	$stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
	$stmt->execute(array(':username' => $username, ':password' => $hash_password));
	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	if( $result == FALSE ) {
		return FALSE;
	} else {
		return $result['user_id'];
	}

}
