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
          'src'       => FOUNDATION_ASSETS . '/css/critical.css',
          'dep'       => array(),
          'version'   => wp_get_theme()->get( 'Version' ),
          'media'     => 'all',
        ),
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
      'recommended' => true,
      'type'        => 'bundle',
      'component'   => true,
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
      'recommended' => false, // For display purposes on the Configuration page
      'type'        => false, // css, js, bundle
      'component'   => false, // When true, displays as an auto-load option on the Configuration page
      'css'         => false, // Array
      'js'          => false, // Array
    );

    $options = array_merge( $default, $args );

    // Verify options
    if (
      ! $options['id'] ||
      ! $options['name'] ||
      ! $options['type'] ||
      ( ! $options['css'] && ! $options['js'] ) ||
      $options['css'] && ! is_array( $options['css'] ) ||
      $options['js'] && ! is_array( $options['js'] )
    ) { return false; }

    $this->libraries[ $options['id'] ] = array(
      'name'        => $options['name'],
      'recommended' => $options['recommended'],
      'type'        => $options['type'],
      'component'   => $options['component'],
      'css'         => $options['css'],
      'js'          => $options['js'],
    );

    if ( $options['css'] ) {
      foreach( $options['css'] as $handle => $css ) {
        if ( empty( $css['external'] ) ) {
          $css['src'] = get_stylesheet_directory_uri() . '/' . $css['src'];
        }

        wp_register_style( $handle, $css['src'], $css['dep'], $css['version'], $css['media'] );
      }
    }

    if ( $options['js'] ) {
      foreach( $options['js'] as $handle => $js ) {
        if ( empty( $js['external'] ) ) {
          $js['src'] = get_stylesheet_directory_uri() . '/' . $js['src'];
        }

        wp_register_script( $handle, $js['src'], $js['dep'], $js['version'], $js['in_footer'] );
      }
    }

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
          if ( empty( $js['external'] ) ) {
            $js['src'] = get_stylesheet_directory_uri() . '/' . $js['src'];
          }

          wp_register_script( $handle, $js['src'], $js['dep'], $js['version'], $js['in_footer'] );
        }
      }

      // CSS
      if ( ! empty( $scripts['css'] ) ) {
        foreach( $scripts['css'] as $handle => $css ) {
          if ( empty( $css['external'] ) ) {
            $css['src'] = get_stylesheet_directory_uri() . '/' . $css['src'];
          }

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

      // Auto-load theme libraries
      $theme_libraries = get_field( 'autoload_theme_libraries', 'option' );
      if ( $theme_libraries ) {
        foreach( $theme_libraries as $key => $library ) {
          $this->load_library( $library );
        }
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

function foundation_get_theme_autoloaded_files( $type ) {
  $files = array();

  if ( function_exists( 'get_field' ) ) {
    $theme_libraries = get_field( 'autoload_theme_libraries', 'option' );
    if ( $theme_libraries ) {
      foreach( $theme_libraries as $key => $library ) {
        $scripts = foundation_get_theme_scripts( $library );
        if ( $scripts && ! empty( $scripts[ $type ] ) ) {
          foreach( $scripts[ $type ] as $name => $file ) {
            $files[] = $file['src'];
          }
        }
      }
    }
  }

  return $files;
}