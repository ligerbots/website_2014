<?php
//Include the main page, since that's still necessary
include("../main.php");
//Sanitise all the data

//Gather all data
$username =		mysqli_escape_string($connection, $_POST['username']);
$password =		mysqli_escape_string($connection, $_POST['password']);
$cpassword =	mysqli_escape_string($connection, $_POST['cpassword']);
$firstname =	mysqli_escape_string($connection, $_POST['fname']);
$lastname =		mysqli_escape_string($connection, $_POST['lname']);
$email =		mysqli_escape_string($connection, $_POST['email']);
$phone =		mysqli_escape_string($connection, $_POST['phone']);
$address =		mysqli_escape_string($connection, $_POST['address']);
$city =			mysqli_escape_string($connection, $_POST['city']);
$state =		mysqli_escape_string($connection, $_POST['state']);
$zipcode =		mysqli_escape_string($connection, $_POST['zipcode']);
$category = 	cleanArray($_POST['category']);
//Error variables
$encountered = false;
$string = "err";
//Validate all of the data
if($username == "") {		//Username can not be empty
	$encountered = true;
	$string = $string . "username0";
}
if($password == "") {		//Password can not be empty
	$encountered = true;
	$string = $string . "password0";
}
if($password != $cpassword) {	//Password and confirmation must match
	$encountered = true;
	$string = $string . "password1";
}
if(strlen($password) < 8) {	//Password must be at least 8 characters long
	$encountered = true;
	$string = $string . "password2";
}
if($firstname == "") {		//Firstname can not be empty
	$encountered = true;
	$string = $string . "fname";
}
if($lastname == "") {		//Lastname can not be empty
	$encountered = true;
	$string = $string . "lname";
}
if($email == "") {			//Email address can not be empty
	$encountered = true;
	$string = $string . "email0";
}
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {	//Email address must be valid
	$encountered = true;
	$string = $string . "email1";
}
if($address == "") {		//Address can not be empty
	$encountered = true;
	$string = $string . "address";
}
if($city == "") {
	$encountered = true;
	$string = $string . "city";
}
if($state == "--SELECT--") {
	$encountered = true;
	$string = $string . "state";
}
if($zipcode == "") {
	$encountered = true;
	$string = $string . "zipcode";
}
if($phone == "") {
	$encountered = true;
	$string = $string . "phone";
}
if(count($category) == 0) {	//Category can not be empty
	$encountered = true;
	$string = $string . "cat0";
}
if(count($category) > 2) {	//User can not select more than two categories
	$encountered = true;
	$string = $string . "cat1";
}

//Registration result code
$regres = "registered";

//Reg code result
$regcode = false;

//Check if the activation key has been specified
if($_POST['activationcode'] != "") {
	//Formulate a query to check the code
	$query = "SELECT * FROM " . $meta_table . " WHERE name='activationcode'";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Check the result
	if($result->num_rows == 0) {
		//No keys specified
		$regres = "badkey";
	}
	//Check each registration code
	while($row = $result->fetch_array()) {
		if($row['data'] == $_POST['activationcode']) {
			$regcode = true;
			$regres = "regactivated";
		}
	}
	//Check the regcode result
	if(!$regcode) {
		$regres = "badkey";
	}
}

//Figure out the groups
$groups = "";
foreach($category as $cat) {
	$groups .= mysqli_escape_string($connection, $cat) . "::";
}
$groups = substr($groups, 0, -2);

//Create a query to check if the username is taken
$query = "SELECT * FROM " . $user_table . " WHERE username='" . $username . "'l";
//Execute the query
$result = mysqli_query($connection, $query);
//Check the results
if($result->num_rows > 0) {
	$encountered = true;
	$string = $string . "username1";
}

//In the event that the user screwed up...
if($encountered) {
	//Redirect the user to the registration page
	header('Location: ../../register.php?e=' . $string);
	die();
}

//Formulate a query for creating the new user
$query = "INSERT INTO " . $user_table . " (firstname, lastname, username, password, email, activated, groups, phone, address, city, state, zipcode) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $username . "', '" . sha1($password) . "', '" . $email . "', '" . $regcode . "', '" . $groups . "', '" . $phone . "', '" . $address . "', '" . $city . "', '" . $state . "', '" . $zipcode . "');";

//Execute the query
mysqli_query($connection, $query);

//Clone to the old ligerbots database

//Redirect the user to the login page
header('Location: ../../login.php?e=' . $regres);

//Function for cleaning arrays
function cleanArray($array) {
	global $connection;
	$newArray = array();
	foreach($array as $key=>$value) {
		$newArray[$key] = mysqli_escape_string($connection, $value);
	}
	return $newArray;
}

?>