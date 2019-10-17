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

if ( ! function_exists( 'foundation_theme_activation' ) ) {
  /**
   * Fires when this theme is activated.
   *
   * Adds the Foundation Developer user role.
   *
   * @since 3.0.4
   *
   * @uses add_role() Adds a new role to WordPress.
   * @uses get_role() Retrieve role object.
   * @link https://codex.wordpress.org/Plugin_API/Action_Reference/after_switch_theme
   *
   * @return void
   */
  function foundation_theme_activation() {
    add_role( 'foundation_developer', __( 'Foundation Developer', 'foundation' ), get_role( 'administrator' )->capabilities );
  }
}
add_action( 'after_switch_theme', 'foundation_theme_activation' );

if ( ! function_exists( 'foundation_theme_deactivation' ) ) {
   /**
    * Fires when this theme is deactivated.
    *
    * Removes the Foundation Developer user role.
    *
    * @since 3.0.4
    *
    * @uses remove_role() Removes a role from WordPress.
    * @uses get_role() Retrieve role object.
    * @link https://codex.wordpress.org/Plugin_API/Action_Reference/switch_theme
    *
    * @return void
    */
  function foundation_theme_deactivation() {
    if ( get_role('foundation_developer') ) {
      remove_role( 'foundation_developer' );
    }
  }
}
add_action( 'switch_theme', 'foundation_theme_deactivation' );

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
     * Advanced Custom Fields must be enabled for the Configuration page
     * functionality to be available.
     */
    if ( function_exists( 'get_field' ) ) {
      /**
       * Get & define the default thumbnail size.
       *
       * @link https://developer.wordpress.org/reference/functions/set_post_thumbnail_size/
       */
      $thumbnail_size = get_field( 'foundation_thumbnail_size', 'option' );
      if (
        $thumbnail_size &&
        ( $thumbnail_size['width'] || $thumbnail_size['height'] )
      ) {
        set_post_thumbnail_size(
          $thumbnail_size['width'],
          $thumbnail_size['height'],
          $thumbnail_size['crop']
        );
      }

      /**
       * Get & define post formats for specified post types.
       *
       * @link https://developer.wordpress.org/themes/functionality/post-formats/
       * @link https://developer.wordpress.org/reference/functions/add_post_type_support/
       */
      $post_formats = get_field( 'foundation_post_formats', 'option' );
      if ( $post_formats ) {
        add_theme_support( 'post-formats', $post_formats );
        add_post_type_support( 'post', 'post-formats' );

        $supported = get_field( 'foundation_supported_post_formats', 'option' );
        if ( $supported ) {
          foreach( $supported as $key => $post_type ) {
            add_post_type_support( $post_type, 'post-formats' );
          }
        }
      }

      /**
       * Add support for core custom logo.
       *
       * @link https://codex.wordpress.org/Theme_Logo
       */
      $logo_size = get_field( 'foundation_logo_size', 'option' );
      if ( $logo_size ) {
        add_theme_support(
          'custom-logo',
          [
            'height'      => $logo_size['height'],
            'width'       => $logo_size['width'],
            'flex-width'  => $logo_size['flex_width'],
            'flex-height' => $logo_size['flex_height'],
          ]
        );
      }
    }

    if ( function_exists( 'have_rows' ) ) {
      /**
       * Get & define image sizes.
       *
       * @link https://developer.wordpress.org/reference/functions/add_image_size/
       */
      // Images sizes
      if ( have_rows( 'foundation_images_sizes', 'option' ) ) {
        while( have_rows( 'foundation_images_sizes', 'option' ) ) { the_row();
          add_image_size( get_sub_field( 'id' ), get_sub_field( 'width' ), get_sub_field( 'height' ), get_sub_field( 'crop' ) );
        }
      }

      /**
       * Get & define navigation menus.
       *
       * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
       */
      if ( have_rows( 'foundation_menus', 'option' ) ) {
        $menus = [];
        while( have_rows( 'foundation_menus', 'option' ) ) { the_row();
          $menus[ get_sub_field( 'id' ) ] = get_sub_field( 'name' );
        }
        register_nav_menus( $menus );
      }
    }

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

if ( ! function_exists( 'foundation_admin_init' ) ) {
  /**
   * Admin init hook.
   *
   * @since 3.0.4
   *
   * @uses is_plugin_active() Checks if a plugin is activated.
   * @uses get_field() Returns the value of a specific field.
   * @uses update_field() Updates the value of a specific field.
   * @link https://codex.wordpress.org/Plugin_API/Action_Reference/admin_init
   */
  function foundation_admin_init() {
    if ( function_exists( 'get_field' ) ) {
      /**
       * Update the Gutenberg config option if the Classic Editor plugin is
       * enabled.
       */
      if ( is_plugin_active( 'classic-editor/classic-editor.php' ) ) {
        if ( get_field( 'foundation_enable_gutenberg', 'option' ) ) {
          update_field( 'foundation_enable_gutenberg', false, 'option' );
        }
      } else {
        if ( ! get_field( 'foundation_enable_gutenberg', 'option' ) ) {
          update_field( 'foundation_enable_gutenberg', true, 'option' );
        }
      }
    }
  }
}
add_action( 'admin_init', 'foundation_admin_init' );

if ( ! function_exists( 'foundation_widgets_init' ) ) {
  /**
   * Register widget area.
   *
   * @since 3.0.4
   *
   * @uses have_rows()This function checks to see if a parent field (such as
   * Repeater or Flexible Content) has any rows of data to loop over.
   * @uses the_row() This function will progress the global repeater or flexible
   * content value 1 row
   * @uses register_sidebar() Builds the definition for a single sidebar and
   * returns the ID.
   * @uses get_sub_field() Returns the value of a specific sub field value from a
   * Repeater or Flexible Content field loop.
   * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
   */
  function foundation_widgets_init() {
    if ( function_exists( 'have_rows' ) ) {
      if ( have_rows( 'foundation_sidebars', 'option' ) ) {
        $sidebars = array();
        while( have_rows( 'foundation_sidebars', 'option' ) ) { the_row();
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
}
add_action( 'widgets_init', 'foundation_widgets_init' );

if ( ! function_exists( 'foundation_content_width' ) ) {
  /**
   * Set the content width in pixels, based on the theme's design and stylesheet.
   *
   * Priority 0 to make it available to lower priority callbacks.
   *
   * @since 3.0.4
   *
   * @uses apply_filters() Call the functions added to a filter hook.
   * @link https://codex.wordpress.org/Plugin_API/Action_Reference/after_switch_theme
   * @global int $content_width Content width.
   */
  function foundation_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'foundation_content_width', 1200 );
  }
}
add_action( 'after_setup_theme', 'foundation_content_width', 0 );

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
        $script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
      }
    }
  }
  add_action( 'wp_default_scripts', 'foundation_remove_jquery_migrate' );
}

if ( ! function_exists( 'foundation_head' ) ) {
   /**
    * Adds code in the HTML head.
    *
    * @since 3.0.4
    *
    * @uses get_field() Returns the value of a specific field.
    * @link https://www.advancedcustomfields.com/resources/get_field/
    *
    * @return string The HTML head code.
    */
  function foundation_head() {
    if ( function_exists( 'get_field' ) ) {
      $head_code = get_field( 'foundation_head_code', 'option' );
      if ( $head_code ) {
        echo $head_code;
      }
    }
  }
}
add_action( 'wp_head', 'foundation_head' );

if ( ! function_exists( 'foundation_footer' ) ) {
   /**
    * Adds code in the HTML footer.
    *
    * @since 3.0.4
    *
    * @uses get_field() Returns the value of a specific field.
    * @link https://www.advancedcustomfields.com/resources/get_field/
    *
    * @return string The HTML head code.
    */
  function foundation_footer() {
    if ( function_exists( 'get_field' ) ) {
      $footer_code = get_field( 'foundation_footer_code', 'option' );
      if ( $footer_code ) {
        echo $footer_code;
      }
    }
  }
}
add_action( 'wp_footer', 'foundation_footer' );

if ( function_exists( 'acf_add_options_page' ) ) {
  /**
   * Add configuration page.
   *
   * @since 3.0.4
   *
   * @uses acf_add_options_page() Adds an options page to the admin menu.
   * @link https://www.advancedcustomfields.com/resources/acf_add_options_page/
   */
	$configuration = acf_add_options_page([
    'menu_title' => __( 'Configuration', 'foundation' ),
    'page_title' => __( 'Configuration', 'foundation' ),
    'menu_slug'  => 'foundation_configuration',
    'redirect' 	=> false
  ]);

  /**
   * Add Foundation Libraries configuration child page.
   *
   * @uses acf_add_options_sub_page() This function will add a new options sub
   * page to the wp-admin sidebar.
   * @link https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
   */
  acf_add_options_sub_page([
		'page_title' 	=> __( 'Foundation Libraries' ),
		'menu_title' 	=> 'Foundation Libraries',
		'parent_slug' => $configuration['menu_slug'],
  ]);

  /**
   * Add Theme Libraries configuration child page.
   *
   * @since 3.0.4
   *
   * @uses acf_add_options_sub_page() This function will add a new options sub
   * page to the wp-admin sidebar.
   * @link https://www.advancedcustomfields.com/resources/acf_add_options_sub_page/
   */
  acf_add_options_sub_page([
		'page_title' 	=> __( 'Theme Libraries' ),
		'menu_title' 	=> 'Theme Libraries',
		'parent_slug' => $configuration['menu_slug'],
  ]);
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
