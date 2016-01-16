<?php
// include the main file
include("../main.php");

// Must be logged in
if ( !$loggedin ) {
	header('Location: ../../login.php?e=login');
	die();
}

// Editor only
if ( !$user['editor'] ) {
	header('Location: ../../login.php?e=denied');
	die();
}

// Check if user is specified
if ( !isSet( $_GET['id'] ) ) {
    header('Location: ../../carpools.php');
    die();
}
	
// Get the carpool in question
$id = $_GET['id'];

// Formulate the query
$query = "DELETE FROM $carpool_table WHERE ID=$id;";

// Execute the query
$result = mysqli_query($connection, $query);

// Return
header('Location: ../../carpools.php');
?>