<?php
/**
 * [[THEME_NAME]] functions and definitions
 *
 * @link [[THEME_URL]]
 *
 * @package [[THEME_NAME]]
 * @subpackage Foundation
 * @since 1.0.0
 */

/**
 * This hook is called during each page load, after the theme is initialized.
 * It is generally used to perform basic setup, registration, and init actions
 * for a theme.
 *
 * @since 1.0.0
 *
 * @uses load_theme_textdomain Loads the theme's translated strings.
 * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
 *
 * @return void
 */
function [[TEXT_DOMAIN]]_setup() {
  load_theme_textdomain( '[[TEXT_DOMAIN]]', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', '[[TEXT_DOMAIN]]_setup', 99 );

/**
 * Theme CSS & JS scripts
 */
require get_stylesheet_directory() . '/inc/scripts.php';
