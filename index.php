<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the timezone
	date_default_timezone_set("America/New_York");
	
	//Set the page title
	$title = "Ligerbots Home Page";
	//Load the header
	include("rec/header.php");
	
	
	//If the user is an editor, add a new post button
	if($loggedin) {
			if($user['editor']) {
				echo('<div class="posteditbar"><a href="post.php">New Post</a></div>');
			}
		}
		
	//Load the last 5 blog posts
		//Post array
		$posts = array();
		// Formulate the query. Get them back in time reverse order
		$query = "SELECT * FROM " . $post_table . " ORDER BY time DESC";
		//Execute the query
		$result = mysqli_query($connection, $query);
		//Additional posts to show
		$apos = 0;
		//Check if a start is specified
		if(isSet($_GET['posts'])) {
			$apos = intval($_GET['posts']);
		}
		//Iterate through the result, getting post names
		for($i = 0; $i < ($apos + 5); $i++) {
			if($row = mysqli_fetch_array($result)) {
				$posts[$i] = $row;
			}
		}
	
	//Iterate through the posts and post them
	foreach($posts as $post) {
		//Parse the time
		$date = date("l\, F jS\, Y \a\\t h:i A", $post['time']);
		echo('<div class="post"><ptitle>' . $post['title'] . "</ptitle><br><pinfo>Posted on " . $date . " by " . $post['author'] . '</pinfo><br><div class="content">');
		include("rec/data/blog/" . $post['time'] . ".html");
		echo('</div>');
		//If the user is an editor, give them editor options
		if($loggedin) {
			if($user['editor']) {
				echo('<div class="posteditbar"><a href="epost.php?post=' . $post['time'] . '">Edit post</a> <a href="epost.php?post=' . $post['time'] . '&action=del">Delete</a></div>');
			}
		}
		//Finish off the post
		echo('</div><br>');
	}
	
	//Add the next/previous buttons
	echo('<a href="/?posts=' . ($apos + 5) . '">Show more posts</a>');
?>

<?php
	//Include the footer
	include("rec/footer.php");
?>