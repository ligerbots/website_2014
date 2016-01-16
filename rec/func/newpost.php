<?php
	//Include the main page
	include("../main.php");
	
	//Must be logged in
	if(!$loggedin) {
		echo("MEOW");
		die();
		header('Location: ../../login.php?e=login');
		die();
	}
	//Editor only
	if(!$user['editor']) {
		header('Location: ../../login.php?e=denied');
		die();
	}
	date_default_timezone_set( "America/New_york"); 
	//Get the time
	$time = time();
	//Formulate the query to add the thingy to the stuff
	$query = "INSERT INTO " . $post_table . " (title, time, author) VALUES ('" . $_POST['title'] . "','" . $time . "','" . $user['firstname'] . "')";
	//Execute the query
	mysqli_query($connection, $query);
	//Write the post to a file
	file_put_contents("../data/blog/" . $time . ".html", "<!--POST::" . $time . "!--><!--EDIT:" . $time . "!-->" . PHP_EOL . $_POST['post']);
	//Redirect to home page
	header('Location: ../../index.php');
?>