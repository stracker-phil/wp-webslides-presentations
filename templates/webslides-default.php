<?php
/**
 * Template Name: Default Presentation
 * Description: Displays a webslide presentation.
 *
 * @package WebslidesEditor
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<main role="main">
	<article id="webslides">
		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile; // End of the loop.
		?>
	</article>
</main>

<?php wp_footer(); ?>
<script>
	window.ws = new WebSlides();
</script>

</body>
</html>
