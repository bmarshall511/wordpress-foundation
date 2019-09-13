<?php
$config_file = 'group_5d7974c82f022.json';

function foundation_acf_foundation_libraries_selections( $field ) {
  global $Foundation_Scripts;

  $field['choices'] = array();

  foreach( $Foundation_Scripts->libraries as $library => $ary ) {
    if ( ! $ary['component'] ) { continue; }

    $field['choices'][ $library ] = $ary['name'];

    if ( ! empty( $ary['recommended'] ) && $ary['recommended'] ) {
      $field['choices'][ $library ] .= ' &mdash; <strong>Recommended</strong>';
    }

    switch( $ary['type'] ) {
      case 'js':
        $field['choices'][ $library ] .= ' (JavaScript)';
      break;
      case 'css':
        $field['choices'][ $library ] .= ' (CSS)';
      break;
      case 'bundle':
        $field['choices'][ $library ] .= ' (Bundle)';
      break;
    }

    if ( ! empty ( $ary['url'] ) ) {
      $field['choices'][ $library ] .= ' <a href="' . $ary['url'] . '" target="_blank"><small>Documentation</small></a>';
    }
  }

  return $field;
}
add_filter('acf/load_field/name=autoload_foundation_libraries', 'foundation_acf_foundation_libraries_selections');

function foundation_acf_theme_libraries_selections( $field ) {
  global $Theme_Scripts;

  $field['choices'] = array();

  foreach( $Theme_Scripts->libraries as $library => $ary ) {
    if ( ! $ary['component'] ) { continue; }

    $field['choices'][ $library ] = $ary['name'];

    if ( ! empty( $ary['recommended'] ) && $ary['recommended'] ) {
      $field['choices'][ $library ] .= ' &mdash; <strong>Recommended</strong>';
    }

    switch( $ary['type'] ) {
      case 'js':
        $field['choices'][ $library ] .= ' (JavaScript)';
      break;
      case 'css':
        $field['choices'][ $library ] .= ' (CSS)';
      break;
      case 'bundle':
        $field['choices'][ $library ] .= ' (Bundle)';
      break;
    }
  }

  return $field;
}
add_filter('acf/load_field/name=autoload_theme_libraries', 'foundation_acf_theme_libraries_selections');

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

  wp_enqueue_script( 'foundation-admin-configuration', get_template_directory_uri() . '/' . ASSETS . '/js/wordpress/admin-configuration.js', array( 'jquery'), wp_get_theme()->get( 'Version' ), true );
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