<?php
/**
 * Theme CSS & JS scripts
 *
 * All scripts should try to be organized as individual libraries & loaded only
 * when needed.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 */

use MatthiasMullie\Minify;

class Foundation_Theme_Scripts {
  public $libraries = array();

  public function __construct() {
    // Theme Core
    $this->libraries['theme-core'] = array(
      'name'        => 'Theme Core',
      'css' => array(
        'theme-core-non-critical' => array(
          'src'       => FOUNDATION_ASSETS . '/css/non-critical.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
        'theme-core-print' => array(
          'src'       => FOUNDATION_ASSETS . '/css/print.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'print',
        ),
      ),
      'js' => array(
        'theme-core-foundation' => array(
          'src'       => FOUNDATION_ASSETS . '/js/foundation.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => wp_get_theme()->get( 'Version' ),
          'in_footer' => true,
        ),
      ),
    );

    // WordPress Core
    $this->libraries['wordpress-core'] = array(
      'name'        => 'WordPress Core',
      'css' => array(
        'wordpress-core' => array(
          'src'       => FOUNDATION_ASSETS . '/css/wordpress/core.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
      ),
    );

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_register_scripts' ) );
  }

  /**
   * Adds a new library
   */
  public function add_library( $args ) {
    $default = array(
      'id'          => false, // Unique identifier
      'name'        => false, // Human-readable name
      'css'         => false, // Array
      'js'          => false, // Array
    );

    $options = array_merge( $default, $args );

    // Verify options
    if (
      ! $options['id'] ||
      ! $options['name'] ||
      ( ! $options['css'] && ! $options['js'] ) ||
      $options['css'] && ! is_array( $options['css'] ) ||
      $options['js'] && ! is_array( $options['js'] )
    ) { return false; }

    $this->libraries[ $options['id'] ] = array(
      'name'        => $options['name'],
      'css'         => $options['css'],
      'js'          => $options['js'],
    );

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_register_scripts' ) );

    return $this->libraries[ $options['id'] ];
  }

  /**
   * Register libraries with WordPress
   */
  public function wp_register_scripts() {
    foreach( $this->libraries as $library => $scripts ) {
      // JavaScript
      if ( ! empty( $scripts['js'] ) ) {
        foreach( $scripts['js'] as $handle => $js ) {
          if ( ! wp_script_is( $handle ) ) {
            if ( empty( $js['external'] ) ) {
              $js['src'] = get_stylesheet_directory_uri() . '/' . $js['src'];
            }

            wp_register_script( $handle, $js['src'], $js['dep'], $js['version'], $js['in_footer'] );
          }
        }
      }

      // CSS
      if ( ! empty( $scripts['css'] ) ) {
        foreach( $scripts['css'] as $handle => $css ) {
          if ( ! wp_style_is( $handle ) ) {
            if ( empty( $css['external'] ) ) {
              $css['src'] = get_stylesheet_directory_uri() . '/' . $css['src'];
            }

            wp_register_style( $handle, $css['src'], $css['dep'], $css['version'], $css['media'] );
          }
        }
      }
    }

    /** Replaces WordPress core jQuery library. */
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), $jquery_version );
  }

  /**
   * Loads a pre-defined library
   */
  public function load_library( $library ) {
    // JavaScript
    if ( ! empty( $this->libraries[$library]['js'] ) ) {
      foreach( $this->libraries[$library]['js'] as $handle => $js ) {
        wp_enqueue_script( $handle );
      }
    }

    // CSS
    if ( ! empty( $this->libraries[$library]['css'] ) ) {
      foreach( $this->libraries[$library]['css'] as $handle => $css ) {
        wp_enqueue_style( $handle );
      }
    }
  }
}

$Foundation_Theme_Scripts = new Foundation_Theme_Scripts();

/**
 * Adds a new theme library.
 */
function foundation_add_theme_library( $args ) {
  global $Foundation_Theme_Scripts;

  $Foundation_Theme_Scripts->add_library( $args );
}

/**
 * Loads a specified pre-defined theme library.
 */
function foundation_load_theme_library( $library, $return = false ) {
  global $Foundation_Theme_Scripts;

  $Foundation_Theme_Scripts->load_library( $library );
}

function foundation_get_theme_scripts( $library ) {
  global $Foundation_Theme_Scripts;

  if ( ! empty( $Foundation_Theme_Scripts->libraries[$library] ) ) {
    return $Foundation_Theme_Scripts->libraries[$library];
  }

  return false;
}

function foundation_critical_path_css() {
  $minifier = new Minify\CSS( get_stylesheet_directory() . '/' . FOUNDATION_ASSETS . '/css/critical.css' );
  ob_start();
  ?>
  <style>
    <?php echo $minifier->minify(); ?>
  </style>
  <?php
  echo ob_get_clean();
}
add_action( 'wp_head', 'foundation_critical_path_css' );
