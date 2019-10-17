<?php
/**
 * Theme CSS & JS scripts
 *
 * @package [[THEME_NAME]]
 * @subpackage Foundation
 * @since 1.0.0
 */

/**
 * Register & enqueue theme CSS & JS files
 *
 * For optimum performance, only enqueue files needed for specific pages, post
 * types, archives, taxonomies, etc.
 *
 * @since 3.0.4
 *
 * @uses wp_enqueue_script() Enqueue a script.
 * @uses wp_register_script() Register a new script.
 * @uses wp_enqueue_style() Enqueue a CSS stylesheet.
 * @uses wp_register_style() A safe way to register a CSS style file for later
 * use.
 * @uses foundation_load_theme_library() Loads a pre-defined Foundation library.
 * @uses foundation_load_library() Loads a pre-defined theme library.
 * @link https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 *
 * @return void
 */

function [[TEXT_DOMAIN]]_scripts() {
  /**
   * This is an example of how to load pre-defined Foundation libraries in your
   * theme. For optimum performance, include Foundation CSS & JS direclty into
   * your sass & JS files to avoid additional requests (or use a plugin like
   * Autoptimize to combine & serve your scripts in one file).
   */

  /**
   * Pre-defined Foundation libraries
   *
   * @link https://github.com/bmarshall511/wordpress-foundation/wiki
   */
  //foundation_load_library( 'foundation-toggler' );
  //foundation_load_library( 'foundation-abide' );

  /** Pre-defined registered scripts from libraries */
  //wp_enqueue_script( 'foundation-reveal' );

  /** Custom theme CSS & JS scripts */
  //wp_enqueue_style( '[[TEXT_DOMAIN]]-global', get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/global.css', [], wp_get_theme()->get( 'Version' ) );
  //wp_enqueue_script( '[[TEXT_DOMAIN]]-global', get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/global.js', [ 'jquery' ], wp_get_theme()->get( 'Version' ), true );

  /**
   * Pre-defined theme libraries
   *
   * @link https://github.com/bmarshall511/wordpress-foundation/wiki
   */
  //foundation_load_theme_library( 'theme-core' );
  //foundation_load_theme_library( 'wordpress-core' );
}
add_action( 'wp_enqueue_scripts', '[[TEXT_DOMAIN]]_scripts', 99 );
