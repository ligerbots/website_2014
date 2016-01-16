<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Login to the Ligerbots";
	
	//Load the header
	include("rec/header.php");
	
	//Place for storing the error string
	$error = "";
	//Check for an error
	if(isSet($_GET['e'])) {
		//The user came here because of an error
		if($_GET['e'] == "badtoken") {
			$error = '<div class="error">Your login token is invalid</div>';
		} else if($_GET['e'] == "badlogin") {
			$error = '<div class="error">The username and/or password you specified were invalid</div>';
		} else if($_GET['e'] == "logout") {
			$error = '<div class="message">You have been successfully logged out</div>';
		} else if($_GET['e'] == "registered") {
			$error = '<div class="message">Your account has been created, but is currently awaiting approval from team administrators.  Please sign in below for more information.</div>';
		} else if($_GET['e'] == "badkey") {
			$error = '<div class="message">Your account has been created, but the registration key you provided was invalid.  Please sign in below for more information.</div>';
		} else if($_GET['e'] == "regactivated") {
			$error = '<div class="message">Your account has been created and activated, and is now ready for use</div>';
		} else if($_GET['e'] == "denied") {
			$error = '<div class="error">You do not have permission to view this page</div>';
		} else if($_GET['e'] == "login") {
			$error = '<div class="error">You must be logged in to view this page</div>';
		}
	}
?>

<center>
	<?php echo($error); ?>
	<form action="rec/func/dologin.php" method="post">
		<h1>Login:</h1><br>
		Username:<br>
		<input name="username" type="text"></input><br>
		Password:<br>
		<input name="password" type="password"></input><br><br>
		<input type="submit" value="Log in">
	</form>
</center>

<?php
	//Include the footer
	include("rec/footer.php");
?>