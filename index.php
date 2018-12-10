<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section>
	<main role="main">
		<?php
		if ( have_posts() ) :

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}

			the_posts_pagination();

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
		?>
  </main>
</section>

<?php get_footer();
