<?php
//Include the main page
include("rec/main.php");
//Set the page title
$title = "Verify your Account";
//Load the header
include("rec/header.php");
//Get all users
$query = "SELECT * FROM " . $user_table . " WHERE `verified`='0'";
//Execute the query
$result = mysqli_query($connection, $query);
//Setting time limit
set_time_limit(3600);
//Start the block thing
echo("Sending verification messages to all users...<br>");
$tuser = array();
while($tuser = mysqli_fetch_array($result)) {
//Message out
echo("Sending message to " . $tuser['firstname'] . " " . $tuser['lastname'] . " (" . $tuser['email'] . ")... ");
//Generate a key for the user
$key = sha1(rand());
//Generate query
$query = "UPDATE " . $user_table . " SET `key`='" . $key . "' WHERE `id`=" . $tuser['id'];
//Execute the query
mysqli_query($connection, $query);
//Load the default message
$message = file_get_contents("rec/template/verify.txt");
//Replace the characters
$message = str_replace("%firstname%", $tuser['firstname'], $message);
$message = str_replace("%lastname%", $tuser['lastname'], $message);
$message = str_replace("%email%", $tuser['email'], $message);
$message = str_replace("%phone%", $tuser['phone'], $message);
$message = str_replace("%address%", $tuser['address'], $message);
$message = str_replace("%city%", $tuser['city'], $message);
$message = str_replace("%state%", $tuser['state'], $message);
$message = str_replace("%zipcode%", $tuser['zipcode'], $message);
$message = str_replace("%key%", $key, $message);
//Fill in the email details
$to = $tuser['email'];
$subject = "Verifying your Ligerbots.org account";
$headers = 'From: web' . "@" . 'ligerbots.com' .
"\r\n" .
'X-Mailer: PHP/' . phpversion() . "\r\n";
//Send the message
if(mail($to, $subject, $message, $headers)) {
echo("Success!<br>");
} else {
echo("Failure!<br>");
}
}
//Rename this file
echo("Renaming file to prevent re-execution... ");
if(rename("generateEmailMessages.php", "generateEmailMessages.executed.php")) {
echo("Success!<br>");
} else {
echo("Failure!<br>");
}
//End the thing
echo("Done!");
?>
<center>
<h1>Thank you for verifying your account information</h1>
</center>
<?php
//Include the footer
include("rec/footer.php");
?>