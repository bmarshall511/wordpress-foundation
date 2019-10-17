<?php
/**
 * Additional features to allow styling of the templates, altering outputing.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0.0
 */

if ( ! function_exists( 'foundation_image_size' ) ) {
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
}
add_filter( 'image_size_names_choose', 'foundation_image_size' );


if ( ! function_exists( 'foundation_remove_admin_menu_links' ) ) {
  /**
   * Removes links from the admin menu.
   *
   * @since 3.0.4
   *
   * @see get_field
   * @see remove_menu_page
   * @see wp_get_current_user
   * @link https://codex.wordpress.org/Function_Reference/remove_menu_page
   * @link https://codex.wordpress.org/Function_Reference/wp_get_current_user
   * @link https://www.advancedcustomfields.com/resources/get_field/
   *
   * @return void
   */
  function foundation_remove_admin_menu_links() {
    if ( function_exists( 'get_field' ) ) {
      $user                       = wp_get_current_user();
      $configuration_access_roles = get_field( 'foundation_configuration_access', 'option' );
      $custom_field_access_roles  = get_field( 'foundation_custom_fields_access', 'option' );

      if ( $configuration_access_roles ) {
        /**
         * Remove the Configuration menu link for roles not defined in the
         * Configuration Menu Access field.
         */
        $configuration_diff = array_diff( $user->roles, $configuration_access_roles );

        if ( ! empty( $configuration_diff ) ) {
          remove_menu_page( 'foundation_configuration' );
        }
      }

      if ( $custom_field_access_roles ) {
        /**
         * Remove the Custom Fields menu link for roles not defined in the
         * Custom Fields Menu Access field.
         */
        $custom_fields_diff = array_diff( $user->roles, $custom_field_access_roles );

        if ( ! empty( $custom_fields_diff ) ) {
          remove_menu_page( 'edit.php?post_type=acf-field-group' );
        }
      }
    }
  }
  add_action( 'admin_menu', 'foundation_remove_admin_menu_links', 99 );
}
