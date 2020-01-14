<?php
/**
 * Foundation functions and definitions
 *
 * Do not edit! Contains all Foundation theme functionality. Create a child
 * theme in order to easily upgrade Foundation as new versions are released.
 *
 * PHP version 7
 *
 * @package Foundation
 * @author  Ben Marshall <me@benmarshall.me>
 * @license https://choosealicense.com/licenses/gpl-2.0/ GNU General Public License v2.0
 * @since   1.0.0
 */

if ( ! defined( 'FOUNDATION_ASSETS' ) ) {
  /**
   * @var string FOUNDATION_ASSETS Defines the location of the gulp-foundation
   * assets directory
   */
	define( 'FOUNDATION_ASSETS', 'gulp-foundation' );
}

/**
 * WordPress Foundation only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_parent_theme_file_path( '/inc/back-compat.php' );
	return;
}

/**
 * Vendor files
 */
require get_parent_theme_file_path( '/vendor/autoload.php' );

if ( ! function_exists( 'foundation_setup' ) ) {
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * @since 1.0.0
   *
   * @uses load_theme_textdomain() Loads the theme's translated strings.
   * @uses add_theme_support() Registers theme support for a given feature.
   * @uses get_field() Returns the value of a specific field.
   * @uses have_rows() This function checks to see if a parent field (such as
   * Repeater or Flexible Content) has any rows of data to loop over.
   * @uses set_post_thumbnail_size() Set the default Featured Image dimensions.
   * @uses add_post_type_support() Registers support of certain feature(s) for a
   * given post type.
   * @uses add_image_size() Register a new image size.
   * @uses register_nav_menus() Registers multiple custom navigation menus.
   * @uses remove_action() This function removes a function attached to a
   * specified action hook.
   * @link https://developer.wordpress.org/reference/hooks/after_setup_theme/
   *
   * @return void
   */
	function foundation_setup() {
    /**
     * Make theme available for translation. Translations can be filed in the
     * /languages/ directory.
     *
     * @link https://developer.wordpress.org/reference/functions/load_theme_textdomain/
     */
		load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

		/**
     * Add default posts and comments RSS feed links to head.
     *
     * @link https://codex.wordpress.org/Automatic_Feed_Links
     */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
     *
     * @link https://codex.wordpress.org/Title_Tag
		 */
    add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'script',
        'style',
      ]
		);

		// Remove the meta generator tag
		remove_action( 'wp_head', 'wp_generator' );

		// Remove Windows Live Writer Manifest Link
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Remove Weblog Client Link
		remove_action( 'wp_head', 'rsd_link' );

		// Remove shortlinks
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	}
}
add_action( 'after_setup_theme', 'foundation_setup' );

if ( ! function_exists( 'foundation_scripts' ) ) {
  /**
   * Enqueue scripts and styles.
   *
   * @since 3.0.4
   *
   * @uses is_singular() This conditional tag checks if a singular post is being
   * displayed
   * @uses comments_open() This Conditional Tag checks if comments are allowed for
   * the current Post or a given Post ID.
   * @uses get_option() Retrieves an option value based on an option name.
   * @uses wp_enqueue_script() Enqueue a script.
   * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/
   */
  function foundation_scripts() {
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

    foundation_load_theme_library( 'theme-core' );
  }
}
add_action( 'wp_enqueue_scripts', 'foundation_scripts' );

if ( ! function_exists( 'foundation_remove_jquery_migrate' ) ) {
  /**
   * Removes jQuery Migrate
   *
   * @since 3.0.4
   *
   * @uses is_admin() This Conditional Tag checks if the Dashboard or the
   * administration panel is attempting to be displayed.
   * @link https://developer.wordpress.org/reference/functions/wp_default_scripts/
   */
  function foundation_remove_jquery_migrate( $scripts ) {
    if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
      $script = $scripts->registered['jquery'];

      if ($script->deps) {
        $script->deps = array_diff( $script->deps, [ 'jquery-migrate' ] );
      }
    }
  }
  add_action( 'wp_default_scripts', 'foundation_remove_jquery_migrate' );
}

/**
 * Advanced Custom Field
 */
require get_parent_theme_file_path( '/inc/acf.php' );

/**
 * TGM Plugin Activation
 */
require get_parent_theme_file_path( '/inc/tgm-plugin-activation.php' );

/**
 * Foundation CSS & JS
 */
require get_parent_theme_file_path( '/inc/foundation-scripts.php' );

/**
 * Theme CSS & JS
 */
require get_parent_theme_file_path( '/inc/theme-scripts.php' );

/**
 * Custom login page.
 */
require get_parent_theme_file_path( '/inc/custom-login.php' );

/**
 * Gutenberg editor.
 */
require get_parent_theme_file_path( '/inc/gutenberg.php' );

/**
 * TinyMCE editor.
 */
require get_parent_theme_file_path( '/inc/tinymce.php' );
