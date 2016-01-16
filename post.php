<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "New Blog Post";
	
	//Load the header
	include("rec/header.php");
	
	//Must be logged in
	if(!$loggedin) {
		echo("MEOW");
		die();
		header('Location: login.php?e=login');
		die();
	}
	//Editor only
	if(!$user['editor']) {
		header('Location: login.php?e=denied');
		die();
	}
?>

<script src="//cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script>

<h1>Add a new Blog Post</h1>
<form action="rec/func/newpost.php" method="post">
	Title: <input type="text" name="title"><p>
	<textarea class="ckeditor" name="post"></textarea><p>
	<input type="submit" class="right" value="Submit Post">
</form>

<?php
	//Include the footer
	include("rec/footer.php");
?>