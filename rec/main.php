<?php
//Basic details
$sql_host = "localhost";
$sql_user = "XXX";
$sql_pass = "XXX";
$sql_data = "XXX";

//Table names
$token_table = "XXX";
$user_table = "XXX";
$meta_table = "XXX";
$post_table = "XXX";
$carpool_table = "XXX";

//Establish a database connection
$connection = mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_data) or die("<b>Failed to connect to the database</b>");

//User variables
$user = array();
$loggedin = false;

//Check if a user token is present
if(isSet($_COOKIE['user']) && !isSet($notoken)) {
	//User is set, break down the token to get their information
	$user_exploded = explode("!!", $_COOKIE['user']);
	//Retrieve and sterilize the information
	$raw_username = mysqli_escape_string($connection, $user_exploded[0]);
	$raw_token = 	mysqli_escape_string($connection, $user_exploded[1]);
	//Formulate a query for the user tokens
	$query = "SELECT * FROM " . $token_table . " WHERE username='" . $raw_username . "' AND token='" . $raw_token . "';";
	//Query the table
	$result = mysqli_query($connection, $query);
	//Check if there were any results
	if($result->num_rows > 0) {
		//Formulate a query for the users information
		$query = "SELECT * FROM " . $user_table . " WHERE username='" . $raw_username . "';";
		//Query the database
		$result = mysqli_query($connection, $query);
		//There will be only one result, so get it as the user info
		$user = mysqli_fetch_array($result);
		//Set the user logged in state to true
		$loggedin = true;
	} else {
		setcookie("user", "", time() - 3600);
		header('Location: login.php?e="badtoken"');
	}
}
?>