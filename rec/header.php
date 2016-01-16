<!DOCTYPE html>
<html>
	<head>
		<title><?php echo($title); ?></title>
		<link href="rec/style.css" rel="stylesheet" type="text/css">
		<link href="rec/plusgallery.css" rel="stylesheet" type="text/css">
		<link rel="icon" type="image/ico" href="/favicon.ico">
	</head>
	<body>
	<?php
		//Create the user and admin bar
		include('userbar.php');
		include('adminbar.php');
	?>
		<div class="header">
			<img src="img/logo.svg" id="header-logo">
		</div>
		<div class="navbar">
			<a href="index.php" class="navlink">Home</a>
			<a href="about.php" class="navlink">About</a>
			<a href="contact.php" class="navlink">Contact</a>
			<a href="support.php" class="navlink">Support</a>
			<a href="gallery.php" class="navlink">Gallery</a>
			<a href="ligerblog" class="navlink">LigerBlog</a>
			<a href="fll.php" class="navlink">FLL</a>
			<a href="calendar.php" class="navlink">Calendar</a>
			<a href="carpools.php" class="navlink">Carpools</a>
			<a href="files.php" class="navlink">Files</a>
			<?php
				//Check if the user is logged in
				if($loggedin) {
					if($user['activated']) {
						echo('<a href="directory.php" class="navlink">Directory</a>');
					}
					if($user['editor']) {
						//Add the post bar
						echo('<a href="post.php" class="navlink">Submit new Post</a>');
					}
					if($user['administrator']) {
						//Add the administrative page editor
						echo('<a href="editor.php" class="navlink">Page Editor</a>');
					}
				}
			?>
		</div>
		<div class="main" id="main">
			<div class="content" id="content">