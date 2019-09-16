<?php
/**
 * Gutenburg editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_Gutenburg {
  public $enabled = true;

  public function __construct() {
    if ( function_exists( 'get_field' ) ) {
      $this->enabled = get_field( 'enable_gutenburg', 'option' );
    }

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
    add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
  }

  public function wp_enqueue_scripts() {
    if ( ! $this->enabled ) {
      wp_dequeue_style( 'wp-block-library' );
      wp_dequeue_style( 'wp-block-library-theme' );
    }
  }

  public function after_setup_theme() {
    if ( $this->enabled ) {
      // Add support for editor styles.
      add_theme_support( 'editor-styles' );

      // Add support for Block Styles.
      add_theme_support( 'wp-block-styles' );

      // Add support for full and wide align images.
      add_theme_support( 'align-wide' );

      // Add support for responsive embedded content.
      add_theme_support( 'responsive-embeds' );

      // Add custom editor font sizes.
      add_theme_support(
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
      );

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
    }
  }
}