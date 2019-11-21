<?php
/**
 * TinyMCE editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_TinyMCE {
  public $gutenberg = true;

  public function __construct() {
    if ( function_exists( 'get_field' ) ) {
      $this->gutenberg = get_field( 'foundation_enable_gutenberg', 'option' );
    }

    if ( ! $this->gutenberg ) {
      add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
      add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) );

      add_action( 'admin_init', array( $this, 'editor_styles' ) );
    }
  }

  public function editor_styles() {
    // TinyMCS CSS
    $stylesheets = array();

    if ( function_exists( 'get_field' ) ) {
      // Foundation libraries
      $load_foundation_editor_styles = get_field( 'foundation_editor_load_foundation', 'option' );
      if ( $load_foundation_editor_styles ) {
        $foundation_files = foundation_get_autoloaded_files( 'css' );
        if ( $foundation_files ) {
          $stylesheets = array_merge( $stylesheets, $foundation_files );
        }
      }

      // Theme libraries
      $load_theme_editor_styles = get_field( 'foundation_editor_load_theme', 'option' );
      if ( $load_theme_editor_styles ) {
        $theme_files = foundation_get_theme_autoloaded_files( 'css' );
        if ( $theme_files ) {
          $stylesheets = array_merge( $stylesheets, $theme_files );
        }
      }

      // CSS Files
      if ( have_rows( 'foundation_editor_load_css', 'option' ) ) {
        while ( have_rows( 'foundation_editor_load_css', 'option' ) ) { the_row();
          $css = get_sub_field( 'css_path' );
          if ( $css ) {
            $stylesheets[] = $css;
          }
        }
      }
    }

    $stylesheets[] = FOUNDATION_ASSETS . '/css/wordpress/tinymce-editor.css';

    add_editor_style( $stylesheets );
  }

  public function mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    array_unshift( $buttons, 'fontsizeselect' );

	  return $buttons;
  }

  public function tiny_mce_before_init( $init_array ) {
    $style_formats = array(
      array(
        'title'   => 'Lead',
        'block'   => 'p',
        'classes' => 'lead',
        'wrapper' => false,
      ),
      array(
        'title'   => 'Stat',
        'block'   => 'div',
        'classes' => 'stat',
        'wrapper' => true,
      ),
      array(
        'title'      => 'Button',
        'selector'   => 'a',
        'classes'    => 'button',
      ),
      array(
        'title'      => 'Button (Large)',
        'selector'   => 'a',
        'classes'    => 'button large',
      ),
      array(
        'title'      => 'Hollow Button',
        'selector'   => 'a',
        'classes'    => 'hollow button',
      ),
      array(
        'title'      => 'Hollow Button (Large)',
        'selector'   => 'a',
        'classes'    => 'hollow button large',
      ),
      array(
        'title'      => 'Button (Secondary Color)',
        'selector'   => 'a',
        'classes'    => 'button secondary',
      ),
      array(
        'title'      => 'Button (Secondary Color, Large)',
        'selector'   => 'a',
        'classes'    => 'button secondary large',
      ),
    );

    $init_array['style_formats'] = wp_json_encode( $style_formats );

    return $init_array;
  }
}

$Foundation_TinyMCE = new Foundation_TinyMCE;
