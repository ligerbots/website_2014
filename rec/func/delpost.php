<?php
	//Include the main page
	include("../main.php");
	
	//Must be logged in
	if(!$loggedin) {
		die();
		header('Location: ../../login.php?e=login');
		die();
	}
	//Editor only
	if(!$user['editor']) {
		header('Location: ../../login.php?e=denied');
		die();
	}
	//Formulate the query
	$query = "DELETE FROM " . $post_table . " WHERE time='" . mysqli_escape_string($connection, $_GET['name']) . "'";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Get the time
	$time = $_GET['name'];
	//Discard the original post
	unlink("../data/blog/" . $time . ".html");
	//Redirect the user to the home page
	header('Location: ../../index.php');
?>