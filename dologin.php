<?php
//Specify token ignore
$notoken = true;
//Include the main page, since that's still necessary
include("../main.php");
//Check to make sure the data is present
if(!isSet($_POST['username']) || !isSet($_POST['password'])) {
	//This is a bad request, redirect to the login page and pretend nothing happened.
	header('Location: ../../login.php');
	die();
}
//Get the username and password
$username = mysqli_escape_string($connection, $_POST['username']);
$password = mysqli_escape_string($connection, $_POST['password']);
//Formulate the query
$query = "SELECT * FROM " . $user_table . " WHERE username='" . $username . "' AND password='" . sha1($password) .  "'";
//Query the database
$result = mysqli_query($connection, $query);
//Check the length of the result
if($result->num_rows == 0) {
	//Bad login
	header('Location: ../../login.php?e=badlogin');
	die();
}
//Get the user information
$user = mysqli_fetch_array($result);
//Get the user IP address
$ip = $_SERVER['REMOTE_ADDR'];
//Get the time
$time = time();
//Get the expiration date
$expiration = time() + (86400*3);
//Create a token for the user
$token = sha1(mt_rand(0, mt_getrandmax()));
//Formulate a query to save the token to the database
$query = "INSERT INTO `" . $token_table . "` VALUES ('" . $user['username'] . "','" . $ip . "','" . $time . "','" . $expiration . "','" . $token . "');";
echo($query);
die();
//Query the database
mysqli_query($connection, $query);
//Generate the user cookie
setcookie("user", $user['username'] . "!!" . $token, time() + (3600 * 24), "/");
//Redirect the user to the home page
header('Location: ../../index.php');
?>