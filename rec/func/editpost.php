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
	$query = "SELECT 1 FROM " . $post_table . " WHERE time='" . $_POST['name'] . "'";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Get the resulting post data
	$pdata = mysqli_fetch_array($result);
	//Formulate the new query
	$query = "UPDATE " . $post_table . " SET title='" . $_POST['title'] . "', etime='" . time() . "', eauthor='" . $user['firstname'] . "' WHERE title='" . $_POST['oldtitle'] . "'";
	//Execute the query
	mysqli_query($connection, $query);
	//Get the time
	$time = $_POST['name'];
	//Discard the original post
	unlink("../data/blog/" . $time . ".html");
	//Write the post to a `
	file_put_contents("../data/blog/" . $time . ".html", "<!--POST::" . $time . "!--><!--EDIT:" . $time . "!-->" . PHP_EOL . $_POST['post']);
	//Redirect the user to the home page
	header('Location: ../../epost.php?post=' . $_POST['name'] . '&e=saved');
?>