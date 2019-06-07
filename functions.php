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

if ( ! defined( 'ASSETS' ) ) {
	define( 'ASSETS', 'gulp-foundation' );
}

/**
 * WordPress Foundation only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

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
		//set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		/*register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'foundation' ),
				'footer' => __( 'Footer Menu', 'foundation' ),
				'social' => __( 'Social Links Menu', 'foundation' ),
			)
		);*/

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
		/*add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);*/

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'assets/css/style-editor.css' );

		// Add custom editor font sizes.
		/*add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'foundation' ),
					'shortName' => __( 'S', 'foundation' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'foundation' ),
					'shortName' => __( 'M', 'foundation' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'foundation' ),
					'shortName' => __( 'L', 'foundation' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'foundation' ),
					'shortName' => __( 'XL', 'foundation' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);*/

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'foundation' ),
					'slug'  => 'primary',
					'color' => '#1779ba',
				),
				array(
					'name'  => __( 'Secondary', 'foundation' ),
					'slug'  => 'secondary',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'Dark Gray', 'foundation' ),
					'slug'  => 'dark-gray',
					'color' => '#8a8a8a',
				),
				array(
					'name'  => __( 'Light Gray', 'foundation' ),
					'slug'  => 'light-gray',
					'color' => '#e6e6e6',
				),
				array(
					'name'  => __( 'White', 'foundation' ),
					'slug'  => 'white',
					'color' => '#fefefe',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Remove the meta generator tag
		remove_action('wp_head', 'wp_generator');

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
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foundation_widgets_init() {

	/*register_sidebar(
		array(
			'name'          => __( 'Footer', 'foundation' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'foundation' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);*/

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
	// Comment out the below if using Gutenburg
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );

	// Uncomment if not inlining the critical CSS.
	//wp_enqueue_style( 'foundation-style', get_template_directory_uri() . '/' . ASSETS . '/css/critical.css', array(), wp_get_theme()->get( 'Version' ) );
	wp_enqueue_style( 'foundation-style', get_template_directory_uri() . '/' . ASSETS . '/css/non-critical.css', array(), wp_get_theme()->get( 'Version' ) );

	wp_enqueue_style( 'foundation-print-style', get_template_directory_uri() . '/' . ASSETS . '/css/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

  // Core Foundation script, required on all pages.
	wp_enqueue_script( 'foundation-core', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-core.js', array( 'jquery' ), wp_get_theme()->get( 'Version' ), true );

	// Register Foundation components.
	wp_register_script( 'foundation-media-query', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-media-query.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-motion', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-motion.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-keyboard', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-keyboard.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-triggers', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-triggers.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-toggler', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-toggler.js', array( 'foundation-motion', 'foundation-triggers' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-box', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-box.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-image-loader', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-image-loader.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );
	wp_register_script( 'foundation-nest', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-nest.js', array( 'foundation-core' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Off-canvas (https://foundation.zurb.com/sites/docs/off-canvas.html)
	wp_register_script( 'foundation-offcanvas', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-offcanvas.js', array( 'foundation-media-query', 'foundation-keyboard', 'foundation-triggers' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Tooltip (https://foundation.zurb.com/sites/docs/tooltip.html)
	wp_register_script( 'foundation-tooltip', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-tooltip.js', array( 'foundation-box', 'foundation-media-query', 'foundation-triggers' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Reveal (https://foundation.zurb.com/sites/docs/reveal.html)
	wp_register_script( 'foundation-reveal', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-reveal.js', array( 'foundation-keyboard', 'foundation-triggers', 'foundation-media-query', 'foundation-motion' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Tabs (https://foundation.zurb.com/sites/docs/tabs.html)
	wp_register_script( 'foundation-tabs', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-tabs.js', array( 'foundation-keyboard', 'foundation-image-loader' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Drilldown (https://foundation.zurb.com/sites/docs/drilldown-menu.html)
	wp_register_script( 'foundation-drilldown', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-drilldown.js', array( 'foundation-keyboard', 'foundation-nest', 'foundation-box' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation Dropdown (https://foundation.zurb.com/sites/docs/dropdown-menu.html)
	wp_register_script( 'foundation-dropdown', get_template_directory_uri() . '/' . ASSETS . '/js/components/foundation-dropdownmenu.js', array( 'foundation-keyboard', 'foundation-box', 'foundation-nest' ), wp_get_theme()->get( 'Version' ), true );

	// Foundation initialization
	wp_enqueue_script( 'foundation', get_theme_file_uri( '/' . ASSETS . '/js/foundation.js' ), array( 'foundation-core' ),  wp_get_theme()->get( 'Version' ), true );
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
 * Inlines the critical.css file in the head
 */
function foundation_inline_critical() {
	echo '<style>';
	echo file_get_contents( get_theme_file_uri( '/' . ASSETS . '/css/critical.css' ) );
	echo '</style>';
	?>
	<?php
}
add_action('wp_head', 'foundation_inline_critical');

/**
 * Async Elementor generated CSS files
 */
add_filter('style_loader_tag', 'foundation_style_loader_tag');
function foundation_style_loader_tag($tag){
	$tag = preg_replace("/rel='stylesheet' id='elementor/", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\" id='elementor", $tag);

	return $tag;
}

/**
 * Enqueue supplemental block editor styles.
 */
function foundation_editor_customizer_styles() {

	/*wp_enqueue_style( 'foundation-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.0', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'foundation-editor-customizer-styles', foundation_custom_colors_css() );
	}*/
}
add_action( 'enqueue_block_editor_assets', 'foundation_editor_customizer_styles' );

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * TGM Plugin Activation
 */
require get_parent_theme_file_path( '/inc/tgm-plugin-activation.php' );
