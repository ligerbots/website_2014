<?php

//Include the main page
include("rec/main.php");
	
//Set the page title
$title = "Reset Password";
	
//Load the header
include("rec/header.php");
?>

<!-- INSECURE but use obfuscated URL -->
<form action="/reset-password-done.php" method="post">
    <h1>Set new password:</h1><br>
    Username: *<br>
    <input name="username" type="text"></input><br>
    Password: *<br>
    <input name="password" type="password" /><br>
    Confirm Password: *<br>
    <input name="cpassword" type="password" /><p>
    Token: *<br>
    <input name="token" type="text" /><p>
    <input type="submit" value="Set Password" />
</form>

<?php
    //Include the footer
    include("rec/footer.php");
?>