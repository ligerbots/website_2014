<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots User Management";
	
	//Must be logged in
	if(!$loggedin) {
		header('Location: login.php?e=login');
		die();
	}
	//Admin only
	if(!$user['administrator']) {
		header('Location: login.php?e=denied');
		die();
	}
	
	//Check if user is specified
	if(!isSet($_GET['id'])) {
		header('Location: users.php');
		die();
	}
	
	//Load the header
	include("rec/header.php");
	
	//Get the user in question
	$id = $_GET['id'];
	
	//Place for storing the error string
	$error = "";
	//Check for an error
	if(isSet($_GET['e'])) {
		//The user came here because of an error
		if($_GET['e'] == "success") {
			$error = '<div class="message">The user information has been updated</div><p>';
		}
	}
	//Load the users
		//Formulate a query
		$query = "SELECT * FROM " . $user_table . " WHERE `id`='" . $id . "'";
		//Execute the query
		$result = mysqli_query($connection, $query);
		//Process the user
		$userdata = mysqli_fetch_array($result);
?>

<center>
	<h1>Managing user <?php echo($userdata['username']); ?>:</h1>
	<?php echo($error); ?>
	<a href="rec/func/deluser.php?id=<?php echo($id); ?>">Delete User</a>&nbsp;&nbsp;
	<form action="rec/func/updateuser.php" method="post">
		<table class="usertable">
			<tr class="row">
				<td class="cell"><b>Field:</b></td>
				<td class="cell"><b>Value:</b></td>
			</tr>
			<tr class="row">
				<td class="cell">Username:</td>
				<td class="cell"><input type="text" name="username" class="hiddeninput" value="<?php echo($userdata['username']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Password:</td>
				<td class="cell"><input type="text" name="password" class="hiddeninput"></td>
			</tr>
			<tr class="row">
				<td class="cell">Firstname:</td>
				<td class="cell"><input type="text" name="firstname" class="hiddeninput" value="<?php echo($userdata['firstname']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Lastname:</td>
				<td class="cell"><input type="text" name="lastname" class="hiddeninput" value="<?php echo($userdata['lastname']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Email address:</td>
				<td class="cell"><input type="text" name="email" class="hiddeninput" value="<?php echo($userdata['email']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Phone:</td>
				<td class="cell"><input type="text" name="phone" class="hiddeninput" value="<?php echo($userdata['phone']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Address:</td>
				<td class="cell"><input type="text" name="address" class="hiddeninput" value="<?php echo($userdata['address']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">City:</td>
				<td class="cell"><input type="text" name="city" class="hiddeninput" value="<?php echo($userdata['city']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">State:</td>
				<td class="cell"><input type="text" name="state" class="hiddeninput" value="<?php echo($userdata['state']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Zip code:</td>
				<td class="cell"><input type="text" name="zipcode" class="hiddeninput" value="<?php echo($userdata['zipcode']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Groups:</td>
				<td class="cell"><input type="text" name="groups" class="hiddeninput" value="<?php echo($userdata['groups']); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Verified:</td>
				<td class="cell"><input type="text" name="verified" class="hiddeninput" value="<?php echo(tf($userdata['verified'])); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Activated:</td>
				<td class="cell"><input type="text" name="activated" class="hiddeninput" value="<?php echo(tf($userdata['activated'])); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Administrator:</td>
				<td class="cell"><input type="text" name="administrator" class="hiddeninput" value="<?php echo(tf($userdata['administrator'])); ?>"></td>
			</tr>
			<tr class="row">
				<td class="cell">Editor:</td>
				<td class="cell"><input type="text" name="editor" class="hiddeninput" value="<?php echo(tf($userdata['editor'])); ?>"></td>
			</tr>
			<input type="text" name="oldusername" class="invisible" value="<?php echo($userdata['username']); ?>">
		</table><p>
		<input type="submit" name="submit" value="Save changes">
	</form>
</center>

<?php
	//TF function
	function tf($in) {
		if($in) {
			return "True";
		} else {
			return "False";
		}
	}
	//Include the footer
	include("rec/footer.php");
?>