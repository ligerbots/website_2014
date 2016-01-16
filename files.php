<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the timezone
	date_default_timezone_set("America/New_York");
	
	//Set the page title
	$title = "Ligerbots Files";
	//Load the header
	include("rec/header.php");
?>
<p>
Use the link below to access the Ligerbots file repository on Google Drive. You'll find all the teams documents, presentations, sign-up lists, forms, etc. arranged in a hieararchical tree.
<p align="center">
	<a _target="blank" href="https://drive.google.com/a/ligerbots.com/folderview?hl=en&id=0B6ZCZy-m4nRUbWkwdWRfblJGYVk#list">
	<span style="color: #FFFF00">https://drive.google.com/a/ligerbots.com/folderview?hl=en&amp;id=0B6ZCZy-m4nRUbWkwdWRfblJGYVk#list</span></a>
</p>
<p>
You will need to login using a Google Account in order to access the files. All students, parents, mentors, and coaches who are part of the team should be in one of the team's Google Groups. All members of these groups have access to the file store. 
<span style="color: #FFFF00">You should login to the Google Drive using the the same email address that you use to receive team email.</span></p>
<p>
<p style="border-style: solid; border-width: 1px; padding: 1px 4px">
<em>If you're 
looking for our CAD -- that's kept in PTC Windchill. Talk to one of the Mech E. 
mentors..</em></p>

Once you open the Google Drive, you might want to follow these steps in order to 
better navigate the folder tree. First, click on "Open in Drive":</p>
<p>
<img alt="Google Drive Open in Drive" longdesc="Open in Drive" src="img/openindrive.png"></p>

<p>.. and then:</p>

<table>
	<tr>
		<td><img alt="Google Drive My Drive" longdesc="My Drive" src="img/mydrive.png"></td>
		<td>&nbsp;</td>
		<td>Click on <strong>My Drive <br></strong>to expand the folder<br>
		listing. --&gt;</td>
		<td>&nbsp;</td>
		<td>
		<img alt="Google Drive My Drive expanded" longdesc="Google Drive My Drive expanded" src="img/mydriveexpanded.png"></td>
	</tr>
</table>

<?php
	//Include the footer
	include("rec/footer.php");
?>