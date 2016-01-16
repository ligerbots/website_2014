<?php
	//Include the main document
	include("../main.php");
	
	//Must be logged in
	if(!$loggedin) {
		header('Location: login.php?e=login');
		die();
	}
	//Admin only
	if(!$user['administrator']) {
		header('Location: login.php?e=denied');
		die();
	}
	//Check if user is specified
	if(!isSet($_GET['id'])) {
		header("Location: ../../users.php");
		die();
	}
	//Create the query
	$query = "DELETE FROM " . $user_table . " WHERE `id`=" . mysqli_escape_string($connection, $_GET['id']) . "";
	
	//Execute the query
	mysqli_query($connection, $query);
	
	//Go back to users
	header("Location: ../../users.php");
?>