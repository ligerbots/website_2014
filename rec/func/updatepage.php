<?php
//include the main file
include("../main.php");

//Must be logged in
if(!$loggedin) {
	echo("MEOW");
	die();
	header('Location: ../../login.php?e=login');
	die();
}
//Admin only
if(!$user['administrator']) {
	header('Location: ../../login.php?e=denied');
	die();
}

//Get the filename
$fname = $_POST['f'];
//Delete the old file
unlink("../../" . $fname);
//De-neutralize the php, and un-escape characters
$_POST['page'] = str_replace("&lt;", "<", $_POST['page']);
$_POST['page'] = str_replace("&gt;", ">", $_POST['page']);
$_POST['page'] = str_replace('\\"', '"', $_POST['page']);
$_POST['page'] = str_replace("\\'", "'", $_POST['page']);
$_POST['page'] = str_replace("\\\\", "\\", $_POST['page']);
//Decode the page
$page = html_entity_decode($_POST['page']);
//Write the new file
file_put_contents("../../" . $fname, $page);
//Return
header('Location: ../../editor.php?p=' . $fname . '&e=saved');
?>