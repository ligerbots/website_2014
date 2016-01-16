<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots Home Page";
	
	//Load the header
	include("rec/header.php");
	
	//Must be logged in
	if(!$loggedin) {
		header('Location: ../../login.php?e=login');
		die();
	}
	//Admin only		CHANGED TO EDITOR
	if(!$user['editor']) {
		header('Location: ../../login.php?e=denied');
		die();
	}
	
	//Place for storing the error string
	$error = "";
	//Check for an error
	if(isSet($_GET['e'])) {
		//The user came here because of an error
		if($_GET['e'] == "saved") {
			$error = '<center><div class="message">The page has been updated</div><p></center>';
		}
	}
	
	//Edit mode variable
	$edit = false;
	//Check if a page is specified
	if(isSet($_GET['p'])) {
		$edit = true;
		$rawpage = file_get_contents($_GET['p']);
		$rawpage = str_replace("<?", "PHP_OPEN_TAG", $rawpage);
		$rawpage = str_replace("?>", "PHP_CLOSE_TAG", $rawpage);
		$rawpage = str_replace('"', "DOUBLE_QUOTE_THINGY", $rawpage);
		$rawpage = str_replace("'", "SINGLE_QUOTE_THINGY", $rawpage);
		$page = htmlspecialchars($rawpage);
		$page = str_replace("PHP_OPEN_TAG", "&lt;?", $page);
		$page = str_replace("PHP_CLOSE_TAG", "?&gt;", $page);
		$page = str_replace("DOUBLE_QUOTE_THINGY", '"', $page);
		$page = str_replace("SINGLE_QUOTE_THINGY", "'", $page);
	}
	
	//Display the appropriate content
	if(!$edit) {
		//Skip the editor, go to select
		goto select;
	}
?>
<form action="rec/func/updatepage.php" method="post" onsubmit="this.textarea.value = editor.getSession().getValue()">
	<center><h1>Editing page <?php echo($_GET['p']) ?>:</h1><?php echo($error); ?><br></center>
	
	<input type="text" class="invisible" name="f" value="<?php echo($_GET['p']); ?>">
	<textarea id="textarea" name="page" class="invisible"></textarea><p>
	<div id="editor" name="editor"><?php echo($page); ?></div>
	<input type="submit" class="right" value="Save changes" onclick="textarea.val(editor.getSession().getValue());">
</form>
    
<script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.3/ace.js" type="text/javascript" charset="utf-8"></script>
<div class="editorpane">
	<script>
		var editor = ace.edit("editor");
		editor.setTheme("ace/theme/idle_fingers");
		editor.getSession().setMode("ace/mode/php");
	</script>
</div>

<?php
//Skip this section
goto end;
//File selection marker
select:
?>

Under construction

<?php
	//End selector, allows skipping of selection section of document
	end:
	//Include the footer
	include("rec/footer.php");
?>