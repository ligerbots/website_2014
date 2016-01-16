<?php
//Include the main page
include("rec/main.php");

//Set the page title
$title = "LigerBots Photos";

//Load the header
include("rec/header.php");

// Get the carpool in question
$album = $_GET['album'];

echo( '<div id="plusgallery" class="carpool" data-type="flickr" data-api-key="e16091c794582c8bdac638bb8c62336e" data-userid="127608154@N06"' );
echo( ' data-album-id="' . $album . '" data-limit="300" data-album-title="true"></div>' );
// Not working
//echo( ' data-include="' . $albums . '" data-limit="300" data-album-title="true"></div>' );
?>

<script src="javascript/jquery-1.7.2.min.js"></script>
<script>window.jQuery || document.write("<script src='javascript/jquery-1.7.2.min.js'>\x3C/script>")</script>
<script src="javascript/plusgallery.js"></script>
<script>
$(function(){
        $('#plusgallery').plusGallery();
    })
</script>

<?php
	//Include the footer
	include("rec/footer.php");
?>
