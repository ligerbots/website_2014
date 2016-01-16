<?php
//Check if the user is logged in
if($loggedin) {
	//The user is logged in, display the appropriate information
	echo('<div class="userbar">Hello ' . $user['firstname'] . '! <a class="navlink" href="logout.php">Log out</a></div>');
	//Check if the user's account is activated
	if(!$user['activated']) {
		//The user is not activated, display the warning
		echo('<div class="warningbar"><b>Notice:</b><p>Your account is not yet activated, and therefore you will not be able to access some components of this site.<p>  The information you provided is currently being reviewed by team administrators, and your account will be activated shortly.  For information on on how to speed up this process, visit your UCP by clicking <a href="ucp.php?ref=activation">Here</a></div>');
	}
} else {
	echo('<div class="userbar">Hello Guest! <a class="navlink" href="login.php">Log in</a><a class="navlink" href="register.php">Register</a></div>');
}

?>