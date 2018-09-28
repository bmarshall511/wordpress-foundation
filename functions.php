<?php
/**
 * Foundation functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 */

/**
 * Foundation only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

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
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/foundation
	 * If you're building a theme based on Foundation, use a find and replace
	 * to change 'foundation' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'foundation' );

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

	//add_image_size( 'foundation-featured-image', 2000, 1200, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'main'    => __( 'Main Menu', 'foundation' ),
		'social' => __( 'Social Menu', 'foundation' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	/*add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );*/

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', foundation_fonts_url() ) );
}
add_action( 'after_setup_theme', 'foundation_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function foundation_content_width() {

	$content_width = 1200;

	/**
	 * Filter Foundation content width of the theme.
	 *
	 * @since Foundation 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'foundation_content_width', $content_width );
}
add_action( 'after_setup_theme', 'foundation_content_width', 0 );

/**
 * Register custom fonts.
 */
function foundation_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	/*$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'foundation' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}*/

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Foundation 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function foundation_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'foundation-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'foundation_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function foundation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'foundation' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'foundation' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'foundation_widgets_init' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function foundation_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'foundation_pingback_header' );

/**
 * Display custom color CSS.
 */
function foundation_colors_css_wrap() {
  require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
?>
	<style>
		<?php echo foundation_custom_colors_css(); ?>
	</style>
<?php
}
add_action( 'wp_head', 'foundation_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function foundation_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'foundation-fonts', foundation_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'foundation-style', get_theme_file_uri( '/assets/css/base.css' ) );

  // Core Foundation script, required on all pages.
	wp_enqueue_script( 'foundation-core', get_theme_file_uri( '/assets/js/components/foundation-core.js' ), array( 'jquery' ), '1.0.0', true );

	// Register Foundation components.
	wp_register_script( 'foundation-media-query', get_theme_file_uri( '/assets/js/components/foundation-media-query.js' ), array( 'foundation-core' ), '1.0.0', true );
	wp_register_script( 'foundation-motion', get_theme_file_uri( '/assets/js/components/foundation-motion.js' ), array( 'foundation-core' ), '1.0.0', true );
	wp_register_script( 'foundation-keyboard', get_theme_file_uri( '/assets/js/components/foundation-keyboard.js' ), array( 'foundation-core' ), '1.0.0', true );
	wp_register_script( 'foundation-triggers', get_theme_file_uri( '/assets/js/components/foundation-triggers.js' ), array( 'foundation-core' ), '1.0.0', true );
	wp_register_script( 'foundation-offcanvas', get_theme_file_uri( '/assets/js/components/foundation-offcanvas.js' ), array( 'foundation-media-query', 'foundation-keyboard', 'foundation-triggers' ), '1.0.0', true );
	wp_register_script( 'foundation-toggler', get_theme_file_uri( '/assets/js/components/foundation-toggler.js' ), array( 'foundation-motion', 'foundation-triggers' ), '1.0.0', true );

	// Enable toggler functionality
	wp_enqueue_script( 'foundation-toggler' );

	// Enable off-canvas functionality.
  //wp_enqueue_script( 'foundation-offcanvas' );
	//wp_enqueue_style( 'foundation-off-canvas', get_theme_file_uri( '/assets/css/components/off-canvas.css' ), array( 'foundation' ), null );

	// Theme global JS.
	wp_enqueue_script( 'foundation', get_theme_file_uri( '/assets/js/foundation.js' ), array( 'foundation-core' ), '1.0.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'foundation_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * TGM Plugin Activation
 */
require get_parent_theme_file_path( '/inc/tgm-plugin-activation.php' );

/**
 * Elementor
 */
require get_parent_theme_file_path( '/inc/elementor/elementor.php' );
