<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Carpools";
		
	//Load the header
	include("rec/header.php");
?>

<center><h1>Meeting Carpools</h1>
<h3>
Monday at South, Room 9170, 6:30-9 PM<br>
Thursday at North, Engineering Room, 6:30-9 PM<br>
<!--
Mondays-Thursdays: 6-9 PM<br>
Fridays: 3-9 PM<br>
Saturdays: 8:30 AM - 2:30 PM<br>
-->
</h3>
<h4>Scroll down for more carpools</h4>
<h2>
<br>
Student Carpool Permission form can be downloaded <a href="/img/docs/Carpool_Permission_2014.pdf" target="_blank"><b>here</b></a>.
<br>
Driver CORI/SORI forms and instructions can be found <a href="http://www.newton.k12.ma.us/Page/2145" target="_blank"><b>here</b></a>.
<br>
</h2>

</center>


<script language="JavaScript">
function autoResize(id)
{
    var newheight;

    if(document.getElementById)
		{
			newheight=document.getElementById(id).Height;
			console.log(newheight)
        }

    document.getElementById(id).height= (newheight) + "px";
}
</script>

<?php
	// If the user is an editor, give them the option to add another carpool
	if ( $user['editor'] ) {
            echo( '<form action="rec/func/addcarpool.php" method="post">' );
            echo( 'Enter ID of carpool to add:<br>' );
            echo( '<input type="text" name="id"><input type="submit" value="Add carpool">' );
            echo( "</form><p>\n" );
	}
	
	// Formulate the query
        // If you want to limit to 5, use the MySQL "LIMIT" operand
	$query = "SELECT * FROM $carpool_table ORDER BY ID";

	// Execute the query
	$result = mysqli_query($connection, $query);

        while ( $row = mysqli_fetch_array($result) ) {
            if ( $user['editor'] ) {
                // Delete button
                echo( '<div style="text-align:right; color:red; font-weight:bold; font-size:larger;"><a href="rec/func/delcarpool.php?id=' . $row[ "ID" ] . '">Delete</a></div>' );
                echo( "\n" );
            }
            echo( '<iframe src="http://www.groupcarpool.com/t/' . $row[ "LABEL" ] . '" class="carpool" id="' . $row[ "ID" ] . '"></iframe>' );
            echo( "\n" );
	}

	//Include the footer
	include("rec/footer.php");
	
	//onLoad="autoResize(' . "'" . $carpool . "'" . ')
?>