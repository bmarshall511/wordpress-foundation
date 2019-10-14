<?php
/**
 * Advanced Custom Fields functions and definitions
 *
 * @package Foundation
 * @since   3.0.4
 */

if ( ! defined( 'FOUNDATION_CONFIG_GROUP_ID' ) ) {
  /**
   * @var string FOUNDATION_CONFIG_GROUP_ID The ID of the ACF Foundation
   * Configuration group.
   */
	define( 'FOUNDATION_CONFIG_GROUP_ID', 'group_5d7974c82f022' );
}

if ( ! defined( 'FOUNDATION_LIB_GROUP_ID' ) ) {
  /**
   * @var string FOUNDATION_LIB_GROUP_ID The ID of the ACF Foundation libraries
   * group.
   */
	define( 'FOUNDATION_LIB_GROUP_ID', 'group_5d838412d6853' );
}

function foundation_acf_foundation_libraries_selections( $field ) {
  global $Foundation_Scripts;

  $field['choices'] = array();

  // Get globally loaded libraries.
  $global_foundation_libraries = false;
  if ( 'foundation_libraries' == $field['name'] ) {
    $global_foundation_libraries = get_field( 'foundation_autoload_foundation_libraries', 'option' );
  }

  foreach( $Foundation_Scripts->libraries as $library => $ary ) {
    if ( ! $ary['component'] ) { continue; }

    $field['choices'][ $library ] = '';

    // Check if a page/post option & if already globally loaded
    if ( $global_foundation_libraries && in_array( $library, $global_foundation_libraries ) ) {
      $field['choices'][ $library ] .= '<a href="' . admin_url('admin.php?page=configuration') . '"><strong>(Included)</strong></a> ';
    }

    $field['choices'][ $library ] .= $ary['name'];

    if ( ! empty( $ary['recommended'] ) && $ary['recommended'] ) {
      $field['choices'][ $library ] .= ' &mdash; <strong>Recommended</strong>';
    }

    if ( ! empty( $ary['css'] ) && ! empty( $ary['js'] ) ) {
      $field['choices'][ $library ] .= ' (Bundle)';
    } elseif( ! empty( $ary['css'] ) ) {
      $field['choices'][ $library ] .= ' (CSS)';
    } elseif( ! empty( $ary['js'] ) ) {
      $field['choices'][ $library ] .= ' (JavaScript)';
    }

    if ( ! empty ( $ary['url'] ) ) {
      $field['choices'][ $library ] .= ' <a href="' . $ary['url'] . '" target="_blank"><small>Documentation</small></a>';
    }
  }

  return $field;
}
add_filter('acf/load_field/name=foundation_autoload_foundation_libraries', 'foundation_acf_foundation_libraries_selections');
add_filter('acf/load_field/name=foundation_libraries', 'foundation_acf_foundation_libraries_selections');

function foundation_acf_theme_libraries_selections( $field ) {
  global $Foundation_Theme_Scripts;

  $field['choices'] = array();

  // Check if a page/post & get globally loaded libraries.
  $global_theme_libraries = false;
  if ( 'theme_libraries' == $field['name'] ) {
    $global_theme_libraries = get_field( 'foundation_autoload_theme_libraries', 'option' );
  }

  foreach( $Foundation_Theme_Scripts->libraries as $library => $ary ) {
    if ( ! $ary['component'] ) { continue; }

    $field['choices'][ $library ] = '';

    // Check if a page/post option & if already globally loaded
    if ( $global_theme_libraries && in_array( $library, $global_theme_libraries ) ) {
      $field['choices'][ $library ] .= '<a href="' . admin_url('admin.php?page=configuration') . '"><strong>(Included)</strong></a> ';
    }

    $field['choices'][ $library ] .= $ary['name'];

    if ( ! empty( $ary['recommended'] ) && $ary['recommended'] ) {
      $field['choices'][ $library ] .= ' &mdash; <strong>Recommended</strong>';
    }

    if ( ! empty( $ary['css'] ) && ! empty( $ary['js'] ) ) {
      $field['choices'][ $library ] .= ' (Bundle)';
    } elseif( ! empty( $ary['css'] ) ) {
      $field['choices'][ $library ] .= ' (CSS)';
    } elseif( ! empty( $ary['js'] ) ) {
      $field['choices'][ $library ] .= ' (JavaScript)';
    }
  }

  return $field;
}
add_filter('acf/load_field/name=foundation_autoload_theme_libraries', 'foundation_acf_theme_libraries_selections');
add_filter('acf/load_field/name=theme_libraries', 'foundation_acf_theme_libraries_selections');

function foundation_acf_export_message( $field ) {
  switch( $field['label'] ) {
    case 'Export Configuration':
      $data = foundation_get_configuration_data();
      ob_start(); ?>
      <p>Copy &amp; paste the code below in the 'Import Configuration' textarea field to import the configuration settings.</p>
      <textarea rows="10" readonly><?php print_r( wp_json_encode( $data ) ); ?></textarea>
      <?php $field['message'] = ob_get_clean();
    break;
    case 'Import Configuration':
      ob_start(); ?>
      <div id="configImportStatus"></div>
      <div id="importBlock">
        <p>Paste the code below from the 'Export Configuration' textarea field to import configuration settings.</p>
        <textarea rows="10" id="configData"></textarea>
        <button class="button button-primary button-large" id="importConfig">Import Configuration</button> <span id="configSavingStatus"></span>
      </div>
      <?php $field['message'] = ob_get_clean();
    break;
  }

  switch( $field['key'] ) {
    case 'field_5d9e3550a4676':
      global $Foundation_Scripts;
      $libraries = $Foundation_Scripts->libraries;

      $field['label'] = count( $libraries ) . __( ' Registered Foundation Libraries', 'foundation' );
      ob_start();
      include( locate_template( 'template-parts/admin/acf-foundation-libraries.php', false, false ) );
      $field['message'] = ob_get_clean();
    break;
    case 'field_5d9e48e944baa':
      global $Foundation_Theme_Scripts;
      $libraries = $Foundation_Theme_Scripts->libraries;
      $field['label'] = count( $libraries ) . __( ' Registered Theme Libraries', 'foundation' );
      ob_start();
      include( locate_template( 'template-parts/admin/acf-foundation-libraries.php', false, false ) );
      $field['message'] = ob_get_clean();
    break;
  }

  return $field;
}
add_filter('acf/load_field/type=message', 'foundation_acf_export_message');

function foundation_acf_admin_scripts( $hook ) {
  if ( 'toplevel_page_configuration' !== $hook ) {
    return;
  }

  wp_enqueue_script( 'foundation-admin-configuration', get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/wordpress/admin-configuration.js', array( 'jquery'), wp_get_theme()->get( 'Version' ), true );
  wp_localize_script( 'foundation-admin-configuration', 'FOUNDATION', array(
    'nonce'     => wp_create_nonce( 'foundation' ),
    'admin_url' => admin_url()
  ) );
}
add_action( 'admin_enqueue_scripts', 'foundation_acf_admin_scripts' );

function foundation_import_configuration() {
  check_ajax_referer( 'foundation', 'security' );

  $response = array(
    'error'   => false,
    'updated' => array()
  );

  $data = ! empty( $_POST['data'] ) ? trim( $_POST['data'] ) : false;

  if ( $data ) {
    $data = str_replace( array( '“', '”', '″' ), '"', $data );
    $data = json_decode( $data, true );

    if ( is_array( $data ) ) {
      $fields = foundation_get_configuration_options();

      foreach( $fields as $key => $field ) {
        if ( $field['name'] ) {
          if ( array_key_exists( $field['name'], $data ) ) {
            update_field( $field['name'], $data[ $field['name'] ], 'option' );
            $response[ 'updated' ][ $field['name'] ] = $field['label'];
          }
        }
      }
    } else {
      $response['error'] = 'invalid_data';
    }
  } else {
    $response['error'] = 'invalid_data';
  }

  echo wp_json_encode( $response );
  exit();
}
add_action( 'wp_ajax_foundation_import_configuration', 'foundation_import_configuration' );

function foundation_get_configuration_data() {
  $data   = array();
  $fields = foundation_get_configuration_options();

  foreach( $fields as $key => $field ) {
    if ( $field['name'] ) {
      $data[ $field['name'] ] = get_field( $field['name'], 'option' );
    }
  }

  return $data;
}

function foundation_get_configuration_options() {
  ob_start();
  require get_parent_theme_file_path( '/acf-json/' . FOUNDATION_CONFIG_GROUP_ID . '.json' );
  $json = ob_get_clean();
  $json = json_decode( $json, true );

  return $json['fields'];
}

function foundation_acf_load_options( $paths ) {
  $paths = array( get_template_directory() . '/acf-json' );

  if( is_child_theme() ) {
    $paths[] = get_stylesheet_directory() . '/acf-json';
  }

  return $paths;
}
add_filter( 'acf/settings/load_json', 'foundation_acf_load_options' );

if ( ! function_exists( 'foundation_acf_post_type_selections' ) ) {
  function foundation_acf_post_type_selections( $field ) {
    $post_types = get_post_types(array(
      'show_ui' => true,
      'public'  => true,
    ));

    unset( $post_types['post'] );
    unset( $post_types['attachment'] );
    if ( ! empty( $post_types['elementor_library'] ) ) {
      unset( $post_types['elementor_library'] );
    }

    $field['choices'] = $post_types;

    return $field;
  }
  add_filter('acf/load_field/name=foundation_supported_post_formats', 'foundation_acf_post_type_selections');
}

if ( ! function_exists( 'foundation_acf_hide_plugin_notice' ) ) {
  /**
   * Removes the required/recommended plugins notice.
   *
   * @since 3.0.4
   *
   * @see wp_get_current_user
   * @see get_field
   * @link https://codex.wordpress.org/Function_Reference/wp_get_current_user
   * @link https://www.advancedcustomfields.com/resources/get_field/
   * @link https://codex.wordpress.org/Plugin_API/Filter_Reference/get_(meta_type)_metadata
   *
   * @param null $null Always null.
   * @param int $object_id ID of the object metadata is for.
   * @param string $meta_key Metadata key.
   * @param bool $single If true the filter should return the value of the metadata field, if false return an array.
   * @return mixed The filter must return null if the data should be taken from the database.
   */
  function foundation_acf_hide_plugin_notice( $null, $object_id, $meta_key, $single ) {
    if ( function_exists( 'get_field' ) && $meta_key === 'tgmpa_dismissed_notice_foundation' ) {
      $user                  = wp_get_current_user();
      $required_plugin_roles = get_field( 'foundation_required_plugins_notice', 'option' );

      if ( $required_plugin_roles ) {
        /**
         * Remove the required/recommended plugins notice for roles not defined
         * in the Required/Recommended Plugins Notice field.
         */
        $required_plugins_diff = array_diff( $user->roles, $required_plugin_roles );

        if ( ! empty( $required_plugins_diff ) ) {
          return true;
        }
      }
    }
  }
  add_filter( 'get_user_metadata', 'foundation_acf_hide_plugin_notice', 10, 4 );
}

if ( ! function_exists( 'foundation_acf_user_role_choices' ) ) {
  /**
   * ACF user roles options.
   *
   * Defines ACF choices for user roles.
   *
   * @since 3.0.4
   *
   * @link https://www.advancedcustomfields.com/resources/acf-load_field/
   * @link https://developer.wordpress.org/reference/classes/wp_roles/
   * @global object $wp_roles Core class used to implement a user roles API.
   *
   * @param string $field The field settings array.
   * @return array The field settings array.
   */
  function foundation_acf_user_role_choices( $field ) {
    global $wp_roles;

    $field['choices'] = [];
    foreach( $wp_roles->roles as $key => $role ) {
      $field['choices'][ $key ] = $role['name'];
    }

    return $field;
  }

  /** Set options for the Configuration Menu Access field */
  add_filter( 'acf/load_field/name=foundation_configuration_access', 'foundation_acf_user_role_choices' );

  /** Set options for the Custom Fields Menu Access field */
  add_filter( 'acf/load_field/name=foundation_custom_fields_access', 'foundation_acf_user_role_choices' );

  /** Set options for the Page/Post Libraries Access field */
  add_filter( 'acf/load_field/name=foundation_libraries_access', 'foundation_acf_user_role_choices' );

  /** Set options for the Required Plugins Notice field */
  add_filter( 'acf/load_field/name=foundation_required_plugins_notice', 'foundation_acf_user_role_choices' );
}

if ( ! function_exists( 'foundation_acf_hide_libraries_meta_box' ) ) {
  /**
   * Removes page/post meta boxes.
   *
   * @since 3.0.4
   *
   * @see wp_get_current_user
   * @see get_field
   * @link https://codex.wordpress.org/Function_Reference/wp_get_current_user
   * @link https://www.advancedcustomfields.com/resources/get_field/
   *
   * @param array $group The group settings array.
   * @return array The group settings array.
   */
  function foundation_acf_hide_libraries_meta_box( $group ) {
    if ( function_exists( 'get_field' ) && FOUNDATION_LIB_GROUP_ID == $group['key'] ) {
      $user                   = wp_get_current_user();
      $libraries_access_roles = get_field( 'foundation_libraries_access', 'option' );

      if ( $libraries_access_roles ) {
        /**
         * Remove the Page Libraries meta box for roles not defined in the
         * Page/Post Libraries Access field.
         */
        $libraries_diff = array_diff( $user->roles, $libraries_access_roles );

        if ( ! empty( $libraries_diff ) ) {
          return false;
        }
      }
    }

    return $group;
  }
  add_filter( 'acf/get_field_group', 'foundation_acf_hide_libraries_meta_box' );
}
