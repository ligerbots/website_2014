<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots Login Management";
	
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
	
	//Load the header
	include("rec/header.php");
	
	//Get the user in question
	$id = $_GET['id'];
	
	//Load the login table
		//Formulate a query
		$query = "SELECT * FROM " . $token_table . " LIMIT 250";
		//Execute the query
		$result = mysqli_query($connection, $query);
		//Process input
		
?>

<center>
	<h1>Recent user logins:</h1>
	<table class="usertable">
		<tr class="row">
			<td class="titlecell" >Time</td>
			<td class="titlecell">Username</td>
			<td class="titlecell">IP Address</td>
			<td class="titlecell">Expiration</td>
			<td class="titlecell">Disconnect</td>
		</tr>
		<?php
		//Generate each of the rows of the table
		while($row = $result->fetch_array()) {
			//ID
			$id = "";
			if(!$row['expiration'] < time()) {
				$id='id="red"';
			}
			echo(
			'<tr class="row" ' . $id . '><td class="cell">' .
			date("n/j/Y g:i A", $row['time']) .
			'</td><td class="cell">' .
			$row['username'] .
			'</td><td class="cell">' .
			$row['address'] .
			'</td><td class="cell">' .
			date("n/j/Y g:i A", $row['expiration']) .
			'</td><td class="cell">' .
			'<a class="userlink" href="rec/func/disconnect?token=">More</a>' .
			'</td></tr>' .
			PHP_EOL);
		}
		?>
	</table>
<?php
	//Include the footer
	include("rec/footer.php");
?>