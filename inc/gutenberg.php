<?php
/**
 * Gutenberg editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_Gutenberg {
  public function __construct() {
    add_action( 'after_setup_theme', array( $this, 'after_setup_theme' ) );
  }

  public function after_setup_theme() {
    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );

    $stylesheets = [ FOUNDATION_ASSETS . '/css/wordpress/gutenberg-editor.css' ];
    $stylesheets = apply_filters( 'foundation_gutenburg_stylesheets', $stylesheets );

    add_theme_support( 'editor-styles' );
    add_editor_style( $stylesheets );

    /**
     * Pre-defined font sizes
     *
     * add_theme_support( 'editor-font-sizes', [
     *   [
     *     'name' => '16px',
     *     'slug' => '16px',
     *     'size' => 16
     *   ]
     * ]);
     */

    /**
     * Pre-defined color palette
     *
     * add_theme_support( 'editor-color-palette', [
     *   [
     *     'name' => 'Primary',
     *     'slug' => 'primary',
     *     'size' => '#000000'
     *   ]
     * ]);
     */

    /**
     * Disable custom colors
     *
     * add_theme_support( 'disable-custom-colors' );
     */

    /**
     * Disable custom font sizes
     *
     * add_theme_support( 'disable-custom-font-sizes' );
     */
  }
}

$Foundation_Gutenberg = new Foundation_Gutenberg;
