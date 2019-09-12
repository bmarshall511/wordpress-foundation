<?php
/**
 * Additional features to allow styling of the templates, altering outputing.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 */

function foundation_image_size( $sizes ) {
  $images_sizes = array();

  if ( function_exists( 'have_rows' ) ) {
    if ( have_rows( 'images_sizes', 'option' ) ) {
      while( have_rows( 'images_sizes', 'option' ) ) { the_row();
        $images_sizes[ get_sub_field( 'id' ) ] = get_sub_field( 'name' );
      }
    }
  }

  return array_merge( $sizes, $images_sizes );
}
add_filter( 'image_size_names_choose', 'foundation_image_size' );