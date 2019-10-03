<?php
/**
 * Gutenberg editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_Gutenberg {
  public $enabled = true;

  public function __construct() {
    if ( function_exists( 'get_field' ) ) {
      $this->enabled = get_field( 'enable_gutenberg', 'option' );
    }

    if ( $this->enabled ) {
      add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
    }

    if ( ! $this->enabled ) {
      add_action( 'wp_enqueue_scripts', array( $this, 'disable_scripts' ) );
    }
  }

  public function disable_scripts() {
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
  }

  public function after_setup_theme() {
    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    // Add support for editor styles.
    $stylesheets = array();

    if ( function_exists( 'get_field' ) ) {
      // Foundation libraries
      $load_foundation_editor_styles = get_field( 'editor_load_foundation', 'option' );
      if ( $load_foundation_editor_styles ) {
        $foundation_files = foundation_get_autoloaded_files( 'css' );
        if ( $foundation_files ) {
          $stylesheets = array_merge( $stylesheets, $foundation_files );
        }
      }

      // Theme libraries
      $load_theme_editor_styles = get_field( 'editor_load_theme', 'option' );
      if ( $load_theme_editor_styles ) {
        $theme_files = foundation_get_theme_autoloaded_files( 'css' );
        if ( $theme_files ) {
          $stylesheets = array_merge( $stylesheets, $theme_files );
        }
      }

      // CSS Files
      if ( have_rows( 'editor_load_css', 'option' ) ) {
        while ( have_rows( 'editor_load_css', 'option' ) ) { the_row();
          $css = get_sub_field( 'css_path' );
          if ( $css ) {
            $stylesheets[] = $css;
          }
        }
      }
    }

    $stylesheets[] = FOUNDATION_ASSETS . '/css/wordpress/gutenberg-editor.css';

    add_theme_support( 'editor-styles' );
    add_editor_style( $stylesheets );

    if ( function_exists( 'get_field' ) ) {
      // Font Sizes
      if ( have_rows( 'gutenberg_font_sizes', 'option') ) {
        $font_sizes = array();
        while ( have_rows( 'gutenberg_font_sizes' ) ) { the_row();
          $font_sizes[] = array(
            'name' => get_sub_field( 'name' ),
            'slug' => get_sub_field( 'slug' ),
            'size' => get_sub_field( 'size' )
          );
        }
        add_theme_support( 'editor-font-sizes', $font_sizes );
      }

      // Color Palette
      if ( have_rows( 'gutenberg_color_palette', 'option') ) {
        $color_palette = array();
        while ( have_rows( 'gutenberg_color_palette' ) ) { the_row();
          $color_palette[] = array(
            'name'  => get_sub_field( 'name' ),
            'slug'  => get_sub_field( 'slug' ),
            'color' => get_sub_field( 'color' )
          );
        }
        add_theme_support( 'editor-color-palette', $color_palette );
      }

      // Disable custom colors?
      $disable_custom_colors = get_field( 'disable_custom_colors', 'option' );
      if ( $disable_custom_colors ) {
        add_theme_support( 'disable-custom-colors' );
      }

      // Disable custom font sizes?
      $disable_custom_font_sizes = get_field( 'gutenberg_disable_custom_font_sizes', 'option' );
      if ( $disable_custom_font_sizes ) {
        add_theme_support( 'disable-custom-font-sizes' );
      }
    }
  }
}

$Foundation_Gutenberg = new Foundation_Gutenberg;
