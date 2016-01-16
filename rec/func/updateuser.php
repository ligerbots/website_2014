<?php
//Include the main file
include("../main.php");
//Must be logged in
if(!$loggedin) {
	header('Location: ../../login.php?e=login');
	die();
}
//Admin only
if(!$user['administrator']) {
	header('Location: ../../login.php?e=denied');
	die();
}
//Create the query
$query = "UPDATE " . $user_table .
" SET `username`='" . e($_POST['username']) . "'," .
"`firstname`='" . e($_POST['firstname']) . "'," .
"`lastname`='" . e($_POST['lastname']) . "',".
"`email`='" . e($_POST['email']) . "'," .
"`phone`='" . e($_POST['phone']) . "'," .
"`address`='" . e($_POST['address']) . "'," .
"`groups`='" . e($_POST['groups']) . "'," .
"`city`='" . e($_POST['city']) . "'," .
"`state`='" . e($_POST['state']) . "'," .
"`zipcode`='" . e($_POST['zipcode']) . "',".
"`activated`='" . tf($_POST['activated']) . "'," .
"`verified`='" . tf($_POST['verified']) . "'," .
"`editor`='" . tf($_POST['editor']) . "'," . 
//Check if the user's password has been modified
if($_POST['password'] != "") {
	$query = $query . "`password`='" . sha1($_POST['password']) . "',";
}
"`administrator`='" . tf($_POST['administrator']) . "'";

/*Parse the group data
$groups = $_POST['groups'];
//Group value
$groupdata = "";
//Add each of the groups to the group value string
foreach($groups as $value) {
	$groupdata = $groupdata . $value . "::";
}

//Chop off the last two characters
$groupdata = substr($groupdata, 0, -2);
//Add the groups to the query
$query = $query . "`groups`='" . $groupdata . "' ";
*/

//DEEEEEEBUG
//$query = $query . "`groups`='' ";

//Add the conditions to the group data
$query = $query . " WHERE `username`='" . $_POST['oldusername'] . "' ";

//Execute the query
mysqli_query($connection, $query);

//Redirect the user to the previous page
header('Location: ../../user.php?u=' . $_POST['username'] . '&e=success');

//Wrapper function for mysqli_escape_string
function e($in) {
	global $connection;
	
	return mysqli_escape_string($connection, $in);
}
//Function for turning true or false into 1 or 0
function tf($in) {
	if(strcasecmp($in, "true") == 0) {
		return 1;
	} else {
		return 0;
	}
}
?>