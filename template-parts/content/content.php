<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0.0
 * @version 2.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<?php
			if ( is_single() ) {
				the_title( '<h1>', '</h1>' );
			} else {
				the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<a href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail(); ?>
		</a>
	<?php endif; ?>

	<?php
		/* translators: %s: Name of current post */
		the_content();

		wp_link_pages();
	?>

	<footer>

	</footer>
</article><!-- #post-## -->
