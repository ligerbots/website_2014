<?php
//Sponsors list (Formatted HTML)
$sponsors = "";
//Load the sponsors file
$raw_sponsors = parse_ini_file("data/sponsors.ini", true);
//For each of the sponsors, add their information to the sponsors list
foreach($raw_sponsors as $sponsor => $data) {
	$sponsors = $sponsors . PHP_EOL . '<a href="' . $data['url'] . '" target="_blank"><img src="' . $data['logo'] . '" alt="' . $data['alt'] . '" title="' . $data['alt'] . '"></a>';
}
?>
			</div>
			<div class="sidebar" id="sidebar">
				<b>Our Sponsors</b><p>
				<?php echo($sponsors); ?>
			</div>
			<div class="clear"></div>
		</div>
		<footer class="footer" id="footer">
			Website &copy;2014-2015 LigerBots, FRC Team 2877
		</footer>
	</body>
</html>