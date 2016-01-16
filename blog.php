<?php 
/* Short and sweet */
define('WP_USE_THEMES', false);
require('./blog/wp-blog-header.php');
	
//Include the main page
	include("rec/main.php");
	
	//Set the timezone
	date_default_timezone_set("America/New_York");
	
	//Set the page title
	$title = "Ligerbots Home Page";
	//Load the header
	include("rec/header.php");
	
	
	//Load the last 5 blog posts

global $post;
$args = array( 'posts_per_page' => 5 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); ?>
<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a><br />
<?php endforeach; ?>


<?php
	//Include the footer
	include("rec/footer.php");
?>