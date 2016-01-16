<?php
//Make sure the user is logged in
if($loggedin) {
	//Check if the user is not an administrator
	if(!$user['administrator']) {
		//The user is not an administrator
		goto end;
	}
} else {
	//User is not logged in
	goto end;
}
//Number of notifications
$notificationcount = 0;
$notifications = "";
//Calculate the number of accounts awaiting activation
	//Formulate the query
	$query = "SELECT * FROM " . $user_table . " WHERE activated='0'";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Tally the result
	$unactivated = $result->num_rows;
	//Create a notification if necessary
	if($unactivated > 0) {
		//Increment the notification variable
		$notificationcount = $notificationcount + 1;
		//Create the notification
		$notifications = $notifications . '<div class="notification_warning">' . $unactivated . ' accounts awaiting activation</div>';
	}
//Calculate the number of accounts awaiting verification
	//Formulate the query
	$query = "SELECT * FROM " . $user_table . " WHERE verified='0'";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Tally the result
	$unverified = $result->num_rows;
	//Create a notification if necessary
	if($unverified > 0) {
		//Increment the notification variable
		$notificationcount = $notificationcount + 1;
		//Create the notification
		$notifications = $notifications . '<div class="notification_warning">' . $unverified . ' accounts awaiting verification</div>';
	}
//Check if there are any notifications
if($notifications == "") {
	$notifications = '<div class="notification_okay">No Notifications</div>';
}
?>
<div class="adminpanel">
	<h3>Admin Panel:</h3>
	<b>Notifications:</b><p>
	<?php echo($notifications); ?><p>
	<b>Links:</b><p>
	<a class="navlink" href="mailto:team@ligerbots.com">Email users</a>
	<a class="navlink" href="users.php">Manage users</a><p>
	<a class="navlink" href="http://cheetah.arvixe.com:2082/" target="_blank">Manage Hosting</a>
</div>
<?php end: ?>