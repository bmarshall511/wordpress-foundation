<?php
/**
 * TinyMCE editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_TinyMCE {

  public function __construct() {
    add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
    add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) );

    add_action( 'admin_init', array( $this, 'editor_styles' ) );
  }

  public function editor_styles() {
    $stylesheets = [ FOUNDATION_ASSETS . '/css/wordpress/tinymce-editor.css' ];
    $stylesheets = apply_filters( 'foundation_tinymce_stylesheets', $stylesheets );
    add_editor_style( $stylesheets );
  }

  /**
   * Filters the second-row list of TinyMCE buttons (Visual tab).
   *
   * @param array $buttons Second-row list of buttons.
   * @return array Updated buttons array.
   */
  public function mce_buttons_2( $buttons ) {
    // Add the style format selector
    array_unshift( $buttons, 'styleselect' );

    // Add the font size selector
    array_unshift( $buttons, 'fontsizeselect' );

	  return $buttons;
  }

  /**
   * Before TinyMCE Initialization
   *
   * @param array $mceInit An array with TinyMCE config.
   * @return array Updated TinyMCE config array.
   */
  public function tiny_mce_before_init( $mceInit ) {
    /**
     * Create pre-defined TinyMCE style formats below.
     *
     * Ex.
     * $style_format[] = [
     *   'title'   => __( 'Title', 'foundation' ),
     *   'block'   => 'p',
     *   'classes' => 'class',
     *   'wrapper' => false
     * ]
     *
     * For more information on style formats and the available format options,
     * see https://www.tiny.cloud/docs/configure/content-formatting/.
     */
    $style_formats = [];
    $style_formats = apply_filters( 'foundation_tinymce_style_formats', $style_formats );
    $mceInit['style_formats'] = wp_json_encode( $style_formats );

    $mceInit['fontsize_formats'] = "8px 10px";

    return $mceInit;
  }
}

$Foundation_TinyMCE = new Foundation_TinyMCE;
