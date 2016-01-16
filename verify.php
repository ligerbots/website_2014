<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Verify your Account";
	
	//Load the header
	include("rec/header.php");
	
	//Verify the user
	$query = "UPDATE " . $user_table . " SET `verified`=1 WHERE `key`='" . mysqli_escape_string($connection, $_GET['key']) . "'";
	//Execute the query
	$result = mysqli_query($connection, $query);
?>

<center>
	<h1>Thank you for verifying your account information!</h1>
</center>
<?php
	//Include the footer
	include("rec/footer.php");
?>