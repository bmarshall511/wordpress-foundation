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
	<?php
		the_content();

		wp_link_pages();
	?>
</article><!-- #post-## -->
