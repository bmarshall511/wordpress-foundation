<?php
/**
 * TinyMCE editor functionality.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 3.0.0
 */

class Foundation_TinyMCE {
  public $gutenburg = true;

  public function __construct() {
    if ( function_exists( 'get_field' ) ) {
      $this->gutenburg = get_field( 'enable_gutenburg', 'option' );
    }

    if ( ! $this->enabled ) {
      add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
      add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ) );
    }
  }

  public function mce_buttons_2() {
    array_unshift( $buttons, 'styleselect' );

	  return $buttons;
  }

  public function tiny_mce_before_init() {
    $style_formats = array(
      array(
        'title'   => '.lead',
        'block'   => 'p',
        'classes' => 'lead',
        'wrapper' => false,
      ),
      array(
        'title'   => '.stat',
        'block'   => 'div',
        'classes' => 'stat',
        'wrapper' => true,
      )
    );

    $init_array['style_formats'] = wp_json_encode( $style_formats );

    return $init_array;
  }
}
