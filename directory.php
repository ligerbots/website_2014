<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots Directory";
	
	//Must be logged in
	if(!$loggedin) {
		header('Location: login.php?e=login');
		die();
	}
	
	//Must be activated
	if(!$user['activated']) {
		header('Location: login.php?e=denied');
		die();
	}
	
	//Load the header
	include("rec/header.php");
	
	//Formulate the query
	$query = "SELECT * FROM " . $user_table . " ORDER BY lastname, firstname ";
	//Execute the query
	$result = mysqli_query($connection, $query);
?>

<script src='rec/script/sorttable.js'></script>

<div style="text-align:center;">
<h1 style="margin-top: 0; margin-bottom: 0;">Ligerbots Directory</h1>
<h5 style="margin-top: 0; margin-bottom: 6pt;">The information on this page is confidential - It is only available to registered and approved users</h5>
<a href="facebook.php">Click here for team "Facebook"</a>
</div>
<br>

<table class="directory sortable">
	<tr class="dheader">
		<!-- <th id="sorttable_nosort"  class="nowrap paddedcell">Picture</th> -->
		<th id="firstname"  class="nowrap paddedcell">First Name</th>
		<th id="lastname"  class="nowrap paddedcell">Last Name</th>
		<th class="sorttable_nosort"  class="nowrap paddedcell">Phone Number</th>
		<th class="sorttable_nosort"  class="nowrap paddedcell">Email Address</th>
		<th class="sorttable_nosort"  class="nowrap paddedcell">Street Address</th>
		<th id="role" class="nowrap paddedcell">Role</th>
	</tr>
<?php
while($row = mysqli_fetch_array($result)) {
	$group = $row['groups'];
	echo('<tr>');
	/* remove pictures echo('<td class="paddedcell"><img src="img/headshot/' . $row['id'] . '.jpg" width="150px">');  */
	echo('<td class="paddedcell">' . $row['firstname'] . '</td>
	      <td class="paddedcell">' . $row['lastname'] . '</td>
		  <td class="paddedcell" id="phone">' . $row['phone'] . '</td>
		  <td class="paddedcell" style="word-break:break-word">' . $row['email'] . '</td>
	      <td class="paddedcell">' . $row['address'] . '<br>' . $row['city'] . " " . 
	      						     $row['state'] . ", " . $row['zipcode'] . '</td>' .
		  '<td class="paddedcell">');
   	if (stripos($group, 'SS') !== false)
	{
		echo('Student South');
	}
	else if (stripos($group, 'NS') !== false)
	{
		echo('Student North');
	}
	if (stripos($group, 'NP') !== false)
	{
		echo('Parent North');
	}
	if (stripos($group, 'SP') !== false)
	{
		echo('Parent South');;
	}
	if (stripos($group, 'CO') !== false)
	{
		echo(' Coach');
	}
	if (stripos($group, 'MN') !== false)
	{
		echo(' Mentor');
	}
	if ($exec = stripos($group, 'EX') !== false)
	{
		echo(' Exec');
	}
 
 	echo('<td></tr>');
}
?>
</table >

<?php
	//Include the footer
	include("rec/footer.php");
?>