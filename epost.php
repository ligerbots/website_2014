<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Blog Post Editor";
	
	//Load the header
	include("rec/header.php");
	
	//Must be logged in
	if(!$loggedin) {
		header('Location: login.php?e=login');
		die();
	}
	//Editor only
	if(!$user['editor']) {
		header('Location: login.php?e=denied');
		die();
	}
	
	//Check for an error
	$error = "";
	if(isSet($_GET['e'])) {
		//The user came here because of an error
		if($_GET['e'] == "saved") {
			$error = '<center><div class="message">The post has been updated</div><p></center>';
		}
	}
	
	//Check if a post has been specified
	if(!isSet($_GET['post'])) {
		goto browser;
	}
	//Load the file
	$post = htmlspecialchars(file_get_contents("rec/data/blog/" . $_GET['post'] . ".html"));
	
	//Formulate the query
	$query = "SELECT * FROM " . $post_table . " WHERE time=" . mysqli_escape_string($connection, $_GET['post']) . "";
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Get the resulting post data
	$pdata = mysqli_fetch_array($result);
	
	//Check if the delete action is specified
	if(isSet($_GET['action'])) {
		if($_GET['action'] == "del") {
			goto delete;
		}
	}
?>

<script src="//cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script>

<h1>Editing Blog Post:</h1>
<?php echo($error); ?>
<form action="rec/func/editpost.php" method="post">
	<input type="hidden" name="name" value="<?php echo($_GET['post']); ?>">
	<input type="hidden" name="oldtitle" value="<?php echo($pdata['title']); ?>">
	<b>Title:</b><input type="text" name="title" value="<?php echo($pdata['title']); ?>"><p>
	<textarea class="ckeditor" name="post"><?php echo($post); ?></textarea><p>
	<input type="submit" class="right" value="Save Changes">
</form>

<?php
//Skip the browser, go to the end
goto end;
browser:
//Post array
	$posts = array();
	//Formulate the query
	$query = "SELECT * FROM " . $post_table;
	//Execute the query
	$result = mysqli_query($connection, $query);
	//Start the table
	echo('<table class="usertable">');
	echo('<tr class="row">');
	echo('<td class="cell">Name</td>');
	echo('<td class="cell">Date</td>');
	echo('<td class="cell">Author</td>');
	echo('<td class="cell">Actions</td>');
	echo('</tr>');
	//Iterate through the result, getting post names
	while($row = mysqli_fetch_array($result)) {
		echo('<tr class="row"><td class="cell">' . $row['title'] . '</td><td class="cell">' . date("n/j/Y g:i A", $row['time']) . '</td><td class="cell">' . $row['author'] . '</td><td class="cell"><a href="epost.php?post=' . $row['time'] . '">Edit post</a></td></tr>');
	}
	//Finish the table
	echo('</table>');
//Go to the end
goto end;
//Marker for the post deletion warning
delete:
echo("<center><h2>Are you sure you wish to delete this post?</h2>");
echo("<b>Title: " . $pdata['title'] . "</b><br>");
echo("<b>Posted: " . date("n/j/Y g:i A", $pdata['time']) . "</b><br>");
echo("<b>Author: " . $pdata['author'] . "</b><p><p>");
echo('<a class="delbutton" id="green" href="rec/func/delpost.php?name=' . $pdata['time'] . '"><b>Yes</b> - <b>DO</b> Delete the post</a>&nbsp;&nbsp;');
echo('<a class="delbutton" id="red" href="javascript:javascript:history.go(-1)"><b>No</b> - Do <b>NOT<b> delete the post</a></center>');
?>

<?php
	//End marker
	end:
	//Include the footer
	include("rec/footer.php");
?>