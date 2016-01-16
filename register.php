<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Register for the Ligerbots";
	
	//Load the header
	include("rec/header.php");
	
	//Place for storing the error string
	$error = "";
	//Check for an error
	if(isSet($_GET['e'])) {
		//The user came here because of an error
		$err = $_GET['e'];
                $error = "There was an error in registration";
		//Check each error code
		if(strpos($err, "fname")) {
			$error .= '<div class="error">You must enter a first name</div>';
		}
		if(strpos($err, "lname")) {
			$error .= '<div class="error">You must enter a last name</div>';
		}
		if(strpos($err, "email0")) {
			$error .= '<div class="error">You must enter an email address</div>';
		}
		if(strpos($err, "email1")) {
			$error .= '<div class="error">The email address you provided is not valid</div>';
		}
		if(strpos($err, "username0")) {
			$error .= '<div class="error">You must enter a username</div>';
		}
		if(strpos($err, "username1")) {
			$error .= '<div class="error">The username you entered is already taken</div>';
		}
		if(strpos($err, "misc")) {
			$error .= '<div class="error">A miscellaneous error was encountered while attempting to process the information you provided</div>';
		}
		if(strpos($err, "password0")) {
			$error .= '<div class="error">You must enter a password</div>';
		}
		if(strpos($err, "password1")) {
			$error .= '<div class="error">Your password and confirmation do not match</div>';
		}
		if(strpos($err, "password2")) {
			$error .= '<div class="error">Your password must be greater than 6 characters long</div>';
		}
		if(strpos($err, "cat0")) {
			$error .= '<div class="error">You must select either one or two categories that apply to you</div>';
		}
		if(strpos($err, "cat1")) {
			$error .= '<div class="error">You must select no more than two categories that apply to you</div>';
		}
		
		if(strpos($err, "phone")) {
			$error .= '<div class="error">You must enter a phone number at which you can be contacted</div>';
		}
		if(strpos($err, "address")) {
			$error .= '<div class="error">You must enter an address</div>';
		}
		if(strpos($err, "city")) {
			$error .= '<div class="error">You must anter a city</div>';
		}
		if(strpos($err, "state")) {
			$error .= '<div class="error">You must select a state</div>';
		}
		if(strpos($err, "zipcode")) {
			$error .= '<div class="error">You must enter a zipcode</div>';
		}
	}
?>

<center>
	<?php echo($error); ?>
	<h1>Register for the Ligerbots:</h1><br>
	<h4>Please note this form is for <u>Team members</u>, <u>mentors</u>, <u>parents</u>, <u>coaches</u>, and <u>Alumni</u> ONLY</h4>
	<h6>Fields marked with an asterisk "*" are required.</h6>
</center>
<form action="rec/func/doregistration.php" method="post">
	First Name: *<br>
	<input name="fname" type="text"><p>
	Last Name: *<br>
	<input name="lname" type="text"><p>
	Desired Username: *<br>
	<input name="username" type="text"><p>
	Password: *<br>
	<input name="password" type="password"><p>
	Confirm Password: *<br>
	<input name="cpassword" type="password"><p>
	Email Address: *<br>
	<input name="email" type="text"><p>
	Phone Number: *<br>
	<input name="phone" type="text"><p>
	Full name of parent(s): (Required for students)<br>
	<input name="parents" type="text"><p>
	Parent's email: (Required for students)<br>  <!--'-->
	<input name="parent_email" type="text"><p>
	Emergency Phone Number: (Required for students)<br>
	<input name="emergency_phone" type="text"><p>
	Address: *<br>
	<input name="address" type="text"><p>
	City: *<br>
	<input name="city" type="text"><p>
	State: *<br>
	<select name="state">
		<option name="state" value="--SELECT--">--SELECT--</option>
		<option name="state" value="MA">Massachusetts</option>
	</select><p>
	Zip Code: *<br>
	<input name="zipcode" type="text"><p>
	Select up to two of the following categories that apply to you: *<br>
	<input type="checkbox" name="category[]" value="NS">North Student<br>
	<input type="checkbox" name="category[]" value="SS">South Student<br>
	<input type="checkbox" name="category[]" value="NP">North Parent<br>
	<input type="checkbox" name="category[]" value="SP">South Parent<br>
	<input type="checkbox" name="category[]" value="MN">Mentor<br>
	<input type="checkbox" name="category[]" value="CO">Coach<br>
	<input type="checkbox" name="category[]" value="AL">Alumni<p>
	Enter your activation code: (Optional)<br>
	<input name="activationcode" type="text"><p>
	<input type="submit" value="Submit Registration">
</form>

<?php
	include("rec/footer.php");
?>