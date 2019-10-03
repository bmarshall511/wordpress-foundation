<?php
$config_file = 'group_5d7974c82f022.json';

function foundation_acf_foundation_libraries_selections( $field ) {
  global $Foundation_Scripts;

  $field['choices'] = array();

  // Get globally loaded libraries.
  $global_foundation_libraries = false;
  if ( 'foundation_libraries' == $field['name'] ) {
    $global_foundation_libraries = get_field( 'autoload_foundation_libraries', 'option' );
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
add_filter('acf/load_field/name=autoload_foundation_libraries', 'foundation_acf_foundation_libraries_selections');
add_filter('acf/load_field/name=foundation_libraries', 'foundation_acf_foundation_libraries_selections');

function foundation_acf_theme_libraries_selections( $field ) {
  global $Foundation_Theme_Scripts;

  $field['choices'] = array();

  // Check if a page/post & get globally loaded libraries.
  $global_theme_libraries = false;
  if ( 'theme_libraries' == $field['name'] ) {
    $global_theme_libraries = get_field( 'autoload_theme_libraries', 'option' );
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
add_filter('acf/load_field/name=autoload_theme_libraries', 'foundation_acf_theme_libraries_selections');
add_filter('acf/load_field/name=theme_libraries', 'foundation_acf_theme_libraries_selections');

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
add_filter('acf/load_field/name=supported_post_formats', 'foundation_acf_post_type_selections');

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
  global $config_file;

  ob_start();
  require get_parent_theme_file_path( '/acf-json/' . $config_file );
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

function foundation_hide_page_libraries( $group ) {
  if ( function_exists( 'get_field' ) && get_field( 'hide_page_libraries', 'option' ) && 'group_5d838412d6853' == $group['key'] ) {
    return false;
  }

  return $group;
}
add_filter( 'acf/get_field_group', 'foundation_hide_page_libraries' );

function foundation_hide_plugin_notice( $val, $object_id, $meta_key, $single ) {
  if ( function_exists( 'get_field' ) && get_field( 'hide_plugins_notice', 'option' ) ) {
    if ( $meta_key === 'tgmpa_dismissed_notice_foundation' ) {
      return true;
    } else {
      return null;
    }
  }
}
add_filter( 'get_user_metadata', 'foundation_hide_plugin_notice', 10, 4 );
