<?php
	//Include the main page
	include("rec/main.php");
	
	//Set the page title
	$title = "Ligerbots Support";
	
	//Load the header
	include("rec/header.php");
?>

<h1><center>Please Support the LigerBots</center></h1>

<form style="text-align: center;" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input style="width: 147px; background: none;" type="image" alt="PayPal - The safer, easier way to pay online!" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif"><br>
<input type="hidden" name="cmd" value="_s-xclick"><br>
<input type="hidden" name="hosted_button_id" value="JV6S3E6HS2KJ6"><br>
</form>

<p>The LigerBots had a great 2014, and now we are having another great year building robots and competing in FIRST FRC. This year, we:
<ul>
<li>Won the Distict Chairman's Award at the UMass Dartmouth Competition</li>
<li>Finished on the 2nd Alliance at the Northeastern District Competition</li>
<li>Won one of the four Regional Chairman's Award at the New England Championships</li>
<li>Were ranked 10th in New England, out of 174 teams
<li>Were invited to and will attend the World Championships in St. Louis</li>
</ul>

<p><b>Now's your chance to support the future engineers and entrepreneurs of Massachusetts.</b> FIRST FRC is a fantastic program promoting STEM education, 
but building the robot and attending the competitions is quite expensive. Please consider donating to support the LigerBots in their return to the World Championships.</p>

<p>Donations are handled through the Newton Schools Foundation.*</p>

<p>If you do not wish to donate via PayPal, you can phone or send a check to the <a href="http://www.newtonschoolsfoundation.org/support/support-overview.html">Newton Schools Foundation</a>; 
please make sure to write "LigerBots" on the check memo to designate the donation for the LigerBots.</p>

<p><small>*The Newton Schools Foundation is registered as a 501(c)(3) non-profit organization. 
Contributions to the Newton Schools Foundation are tax-deductible to the extent permitted by law.</small></p>

<?php
	//Include the footer
	include("rec/footer.php");
?>
