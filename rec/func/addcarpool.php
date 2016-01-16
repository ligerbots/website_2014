<?php
// include the main file
include("../main.php");

// Must be logged in
if(!$loggedin) {
	header('Location: ../../login.php?e=login');
	die();
}

// Editor only
if(!$user['editor']) {
	header('Location: ../../login.php?e=denied');
	die();
}

// Formulate the query
$query = "INSERT INTO $carpool_table (LABEL) VALUES ('" . mysqli_escape_string($connection, $_POST['id']) . "');";

// Execute the query
$result = mysqli_query($connection, $query);

// Return
header('Location: ../../carpools.php');
?>