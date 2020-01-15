<?php
/**
 * Advanced Custom Fields functions and definitions
 *
 * @package Foundation
 * @since   3.0.4
 */

/**
 * Advanced Custom Fields configuration directories
 *
 * @param array $paths Array of paths to ACF JSON configuration files.
 * @return array New array of paths to ACF JSON configuration files.
 */
if ( ! function_exists( 'foundation_acf_load_options' ) ) {
  function foundation_acf_load_options( $paths ) {
    $paths = array( get_template_directory() . '/acf-json' );

    if ( is_child_theme() ) {
      $paths[] = get_stylesheet_directory() . '/acf-json';
    }

    return $paths;
  }
}
add_filter( 'acf/settings/load_json', 'foundation_acf_load_options' );
