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

class Foundation_Theme_Scripts {
  public $libraries = array();

  public function __construct() {
    // Theme Core
    $this->libraries['theme-core'] = array(
      'name'        => 'Theme Core',
      'recommended' => true,
      'type'        => 'bundle',
      'component'   => true,
      'css' => array(
        'theme-core-critical' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/critical.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
        'theme-core-non-critical' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/non-critical.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
        'theme-core-print' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/print.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'print',
        ),
      ),
      'js' => array(
        'theme-core-foundation' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation.js#defer',
          'dep'       => array( 'foundation-core' ),
          'version'   => wp_get_theme()->get( 'Version' ),
          'in_footer' => true,
        ),
      ),
    );

    // WordPress Core
    $this->libraries['wordpress-core'] = array(
      'name'        => 'WordPress Core',
      'recommended' => true,
      'type'        => 'bundle',
      'component'   => true,
      'css' => array(
        'wordpress-core' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/wordpress/core.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
      ),
    );

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_register_scripts' ) );
  }

  /**
   * Register libraries with WordPress
   */
  public function wp_register_scripts() {
    foreach( $this->libraries as $library => $scripts ) {
      // JavaScript
      if ( ! empty( $scripts['js'] ) ) {
        foreach( $scripts['js'] as $handle => $js ) {
          wp_register_script( $handle, $js['src'], $js['dep'], $js['version'], $js['in_footer'] );
        }
      }

      // CSS
      if ( ! empty( $scripts['css'] ) ) {
        foreach( $scripts['css'] as $handle => $css ) {
          wp_register_style( $handle, $css['src'], $css['dep'], $css['version'], $css['media'] );
        }
      }
    }

    if ( function_exists( 'get_field' ) ) {

      // Replace jQuery?
      $jquery_version = get_field( 'jquery_version', 'option' );
      if ( $jquery_version ) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/' . $jquery_version . '/jquery.min.js', array(), $jquery_version );
      }
    }
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

function foundation_async_scripts( $tag, $handle ) {
  if ( strpos( $tag, '#async' ) === false ) {
    return $tag;
  }

  if ( is_admin() ) {
    return str_replace( '#async', '', $tag );
  }

  return str_replace( "#async'>", "' async>", $tag );
}
add_filter( 'script_loader_tag', 'foundation_async_scripts', 10, 2 );

$Foundation_Theme_Scripts = new Foundation_Theme_Scripts();

function foundation_load_theme_library( $library ) {
  global $Foundation_Theme_Scripts;

  $Foundation_Theme_Scripts->load_library( $library );
}