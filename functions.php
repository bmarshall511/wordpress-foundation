<?php
/**
 * Foundation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 2.0.0
 */

if ( ! defined( 'FOUNDATION_ASSETS' ) ) {
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

if ( ! function_exists( 'foundation_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function foundation_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WordPress Foundation, use a find and replace
		 * to change 'foundation' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'foundation', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
    add_theme_support( 'title-tag' );


		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

    if ( function_exists( 'get_field' ) ) {
      // Thumbnail size
      $thumbnail_size = get_field( 'thumbnail_size', 'option' );
      if ( $thumbnail_size ) {
        set_post_thumbnail_size( $thumbnail_size['width'], $thumbnail_size['height'], $thumbnail_size['crop'] );
      }

      // Post formats
      $post_formats = get_field( 'post_formats', 'option' );
      if ( $post_formats ) {
        add_theme_support( 'post-formats', $post_formats );
        add_post_type_support( 'post', 'post-formats' );

        $supported = get_field( 'supported_post_formats', 'option' );
        if ( $supported ) {
          foreach( $supported as $key => $post_type ) {
            add_post_type_support( $post_type, 'post-formats' );
          }
        }
      }
    }

    if ( function_exists( 'have_rows' ) ) {
      // Images sizes
      if ( have_rows( 'images_sizes', 'option' ) ) {
        while( have_rows( 'images_sizes', 'option' ) ) { the_row();
          add_image_size( get_sub_field( 'id' ), get_sub_field( 'width' ), get_sub_field( 'height' ), get_sub_field( 'crop' ) );
        }
      }

      // Menus
      if ( have_rows( 'menus', 'option' ) ) {
        $menus = array();
        while( have_rows( 'menus', 'option' ) ) { the_row();
          $menus[ get_sub_field( 'id' ) ] = get_sub_field( 'name' );
        }
        register_nav_menus( $menus );
      }
    }

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */

    if ( function_exists( 'get_field' ) ) {
      $logo_size = get_field( 'logo_size', 'option' );
      if ( $logo_size ) {
        add_theme_support(
          'custom-logo',
          array(
            'height'      => $logo_size['height'],
            'width'       => $logo_size['width'],
            'flex-width'  => $logo_size['flex_width'],
            'flex-height' => $logo_size['flex_height'],
          )
        );
      }
    }

		// Remove the meta generator tag
		remove_action( 'wp_head', 'wp_generator' );

		// Remove Windows Live Writer Manifest Link
		remove_action( 'wp_head', 'wlwmanifest_link');

		// Remove Weblog Client Link
		remove_action('wp_head', 'rsd_link');

		// Remove shortlinks
		remove_action('wp_head', 'wp_shortlink_wp_head');
	}
endif;
add_action( 'after_setup_theme', 'foundation_setup' );

/**
 * Admin init hook.
 */
if ( ! function_exists( 'foundation_admin_init' ) ) {
  function foundation_admin_init() {
    if ( function_exists( 'get_field' ) ) {
      // Update the Gutenberg config option if the Classic Editor plugin is enabled.
      if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
        if ( get_field( 'enable_gutenberg', 'option' ) ) {
          update_field( 'enable_gutenberg', false, 'option' );
        }
      } else {
        if ( ! get_field( 'enable_gutenberg', 'option' ) ) {
          update_field( 'enable_gutenberg', true, 'option' );
        }
      }
    }
  }
}
add_action( 'admin_init', 'foundation_admin_init' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foundation_widgets_init() {
  if ( function_exists( 'have_rows' ) ) {
    if ( have_rows( 'sidebars', 'option' ) ) {
      $sidebars = array();
      while( have_rows( 'sidebars', 'option' ) ) { the_row();
        register_sidebar(
          array(
            'name'          => get_sub_field( 'name' ),
            'id'            => get_sub_field( 'id' ),
            'description'   => get_sub_field( 'description' ),
            'before_widget' => get_sub_field( 'before_widget' ),
            'after_widget'  => get_sub_field( 'after_widget' ),
            'before_title'  => get_sub_field( 'before_title' ),
            'after_title'   => get_sub_field( 'after_title' ),
          )
        );
      }
    }
  }
}
add_action( 'widgets_init', 'foundation_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function foundation_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'foundation_content_width', 1200 );
}
add_action( 'after_setup_theme', 'foundation_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function foundation_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foundation_scripts' );

/**
 * Removes jQuery Migrate
 */
function foundation_remove_jquery_migrate($scripts) {
	if (!is_admin() && isset($scripts->registered['jquery'])) {
		$script = $scripts->registered['jquery'];

		if ($script->deps) {
			$script->deps = array_diff($script->deps, array(
				'jquery-migrate'
			));
		}
	}
}
add_action( 'wp_default_scripts', 'foundation_remove_jquery_migrate' );

/**
 * Head code
 */
function foundation_head() {
  // @TODO - Inline critical.css.

  if ( function_exists( 'get_field' ) ) {
    $head_code = get_field( 'head_code', 'option' );
    if ( $head_code ) {
      echo $head_code;
    }
  }
}
add_action( 'wp_head', 'foundation_head' );

/**
 * Footer code
 */
function foundation_footer() {
  if ( function_exists( 'get_field' ) ) {
    $footer_code = get_field( 'footer_code', 'option' );
    if ( $footer_code ) {
      echo $footer_code;
    }
  }
}
add_action( 'wp_footer', 'foundation_footer' );

/**
 * Add theme options page.
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( [
    'menu_title' => __( 'Configuration', 'foundation' ),
    'page_title' => __( 'Configuration', 'foundation' ),
    'menu_slug'  => 'configuration'
  ] );
}

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Custom template tags for the theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

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
