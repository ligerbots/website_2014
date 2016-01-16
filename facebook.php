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
	$query = "SELECT *, md5(id) AS hash FROM " . $user_table . " ORDER BY lastname, firstname";
	//Execute the query
	$result = mysqli_query($connection, $query);
?>

<div style="text-align:center;">
<h1 style="margin-top: 0; margin-bottom: 0;">Ligerbots Facebook</h1>
<h5 style="margin-top: 0; margin-bottom: 6pt;">The information on this page is confidential - It is only available to registered and approved users</h5>
<a href="directory.php">Click here to return to the Directory</a>
</div>
<br>

<h2>Students</h2>
<?php

while($row = mysqli_fetch_array($result))
{
	$group = $row['groups'];
	$student = false;
	$exec = false;
	if (stripos($group, 'SS') !== false)
	{
		$student = true;
		$school = 'South';
	}
	else if (stripos($group, 'NS') !== false)
	{
		$student = true;
		$school = 'North';
	}
	$exec = stripos($group, 'EX') !== false;
	
	if ($student)
	{
		echo('<div class="facebook_entry">
				<span style="text-align: center">');
	    include 'img/head.php';
		echo('</span><br>');

		if ($exec)
			echo('<div class="name exec">' . $row['firstname'] . ' ' . $row['lastname']. '</div>');
		else
			echo('<div class="name">' . $row['firstname'] . ' ' . $row['lastname']. '</div>');
		if ($school == 'North')		
			echo('<div style="float:right; color: black;">North&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>');
	    else
			echo('<div style="float:right; color: rgb(0, 110, 255);">South&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>');
		echo('</div>');
	}
}
?>

<div style="clear:left"></div>

<h2>Coaches and Mentors</h2>

<?php
// fetch again

mysqli_data_seek($result, 0);

while($row = mysqli_fetch_array($result))
{
	$group = $row['groups'];
	if (stripos($group, 'MN') !== false || stripos($group, 'CO') !== false)
	{
		echo('<div class="facebook_entry">');
	    include 'img/head.php';
	    echo('<br>
				<span style="text-align:center">' . $row['firstname'] . ' ' . $row['lastname']. '</span>
			 </div>
			 ');
	}
}
?>

<div style="clear:left"></div>
<h2>Parents</h2>
	
	
<?php
// fetch again

mysqli_data_seek($result, 0);

while($row = mysqli_fetch_array($result))
{
	$group = $row['groups'];
	$parent = ( stripos($group, 'NP') !== false || stripos($group, 'SP') !== false );
	$mentor = ( stripos($group, 'MN') !== false || stripos($group, 'CO') !== false );
	if ($parent && !$mentor )
	{
		echo('<div class="facebook_entry">');
	    include 'img/head.php';
		echo('<br>
				<span style="text-align:center">' . $row['firstname'] . ' ' . $row['lastname']. '</span>
			 </div>
			 ');
	}
}
?>



<?php
	//Include the footer
	include("rec/footer.php");
?>