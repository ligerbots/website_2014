<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots User Management";
	
	//Load the header
	include("rec/header.php");
	
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
	//Filter Variables
	$rawsearch = "";
	$search = "";
	$verified = array("", "", "");
	$activated = array("", "", "");
	//Check if verified status is specified
	if(isSet($_GET['v'])) {
		$verified[intval($_GET['v'])] = "selected";
	}
	//Check if activated status is specified
	if(isSet($_GET['a'])) {
		$activated[intval($_GET['a'])] = "selected";
	}
	//Check if a search string is specified
	if(isSet($_GET['search'])) {
		//Save the raw search, to display in the text box
		$rawsearch = $_GET['search'];
		//Set the prefix of the line of code
		$search = "WHERE ";
		//Break down the input string at the spaces
		$terms = explode(" ", $_GET['search']);
		//Iterate through each of the terms, adding to the query
		foreach($terms as $term) {
			$search = $search . '`username` LIKE "%' . $term . '%" OR ';
			$search = $search . '`firstname` LIKE "%' . $term . '%" OR ';
			$search = $search . '`lastname` LIKE "%' . $term . '%" OR ';
			$search = $search . '`email` LIKE "%' . $term . '%" OR ';
			$search = $search . '`phone` LIKE "%' . $term . '%" OR ';
		}
		//Finish off the query with a false statement
		$search = $search . "FALSE";
	}
	//Load the users
		//Formulate a query
		$query = "SELECT * FROM " . $user_table . " " . $search;
		//Execute the query
		$result = mysqli_query($connection, $query);
		//Results are processed below
?>

<center>
	<h1>Users:</h1>
	<b>Filters:</b><br>
		<form action="users.php" method="get">
			<table class="filters">
				<tr>
					<td>Verified:</td>
					<td>
						<select name="v">
							<option value="0" <?php echo($verified[0]); ?>>Ignore</option>
							<option value="1" <?php echo($verified[1]); ?>>Verified</option>
							<option value="2" <?php echo($verified[2]); ?>>Unverified</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Activated:</td>
					<td>
						<select name="v">
							<option value="0" <?php echo($activated[0]); ?>>Ignore</option>
							<option value="1" <?php echo($activated[1]); ?>>Activated</option>
							<option value="2" <?php echo($activated[2]); ?>>Inactivated</option>
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" width="100%"><input type="text" name="search" value="<?php echo($rawsearch) ?>"></td>
				</tr>
			</table>
			<input type="submit" value="Apply"><p>
		</form>
	<table class="usertable">
		<tr class="row">
			<td class="titlecell" id="small">ID</td>
			<td class="titlecell">Username</td>
			<td class="titlecell">First Name</td>
			<td class="titlecell">Last Name</td>
			<td class="titlecell">Email</td>
			<td class="titlecell">Phone</td>
			<td class="titlecell">Actions</td>
		</tr>
		<?php
		//Generate each of the rows of the table
		while($row = $result->fetch_array()) {
			//ID
			$id = "";
			if(!$row['activated'] || !$row['verified']) {
				$id='id="warning"';
			}
			echo(
			'<tr class="row" ' . $id . '><td class="cell">' .
			$row['id'] .
			'</td><td class="cell" style="word-break:break-word">' .
			$row['username'] .
			'</td><td class="cell">' .
			$row['firstname'] .
			'</td><td class="cell">' .
			$row['lastname'] .
			'</td><td class="cell" style="word-break:break-word">' .
			$row['email'] .
			'</td><td class="cell" id="phone">' .
			$row['phone'] .
			'</td><td class="cell">' .
			'<a class="userlink" href="user.php?id=' . $row['id'] . '">More</a>' .
			'</td></tr>' .
			PHP_EOL);
		}
		?>
	</table>
</center>

<?php
	//Include the footer
	include("rec/footer.php");
?>