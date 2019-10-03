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

function foundation_remove_menus() {
  if ( function_exists( 'get_field' ) ) {
    if ( get_field( 'hide_configuration_menu', 'option' ) ) {
      remove_menu_page( 'configuration' );
    }

    if ( get_field( 'hide_custom_fields_menu', 'option' ) ) {
      remove_menu_page( 'edit.php?post_type=acf-field-group' );
    }
  }
}
add_action( 'admin_menu', 'foundation_remove_menus', 99 );
