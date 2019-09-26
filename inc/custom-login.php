<?php
/**
 * Foundation: Custom login page overrides.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0.0
 */

if ( ! function_exists( 'foundation_login_enqueue_scripts' ) ):
function foundation_login_enqueue_scripts() {
  $logo = false;

  if ( has_custom_logo() ) {
    $logo = get_theme_mod( 'custom_logo' );
    $logo = wp_get_attachment_image_src( $logo , 'full' );

    $width = $logo[1] ? $logo[1] . 'px' : 'auto';
    $height = $logo[2] ? $logo[2] . 'px' : 'auto';
  }
  ?>
  <style>
    <?php if ( $logo ) { ?>
    #login h1 a,
    .login h1 a {
      background-image: url('<?php echo $logo[0]; ?>');
      background-size: contain;
      height: <?php echo $height; ?>;
      width: <?php echo $width; ?>;
    }
    <?php } ?>
  </style>
  <?php
}
endif;
add_action( 'login_enqueue_scripts', 'foundation_login_enqueue_scripts' );

if ( ! function_exists( 'foundation_login_logo_url' ) ):
function foundation_login_logo_url() {
  return home_url();
}
endif;
add_filter( 'login_headerurl', 'foundation_login_logo_url' );

if ( ! function_exists( 'foundation_login_headertext' ) ):
function foundation_login_headertext() {
  return get_bloginfo('name') . ' ' . __('Log In', 'foundation');
}
endif;
add_filter( 'login_headertext', 'foundation_login_headertext' );

if ( ! function_exists( 'foundation_login_stylesheet' ) ):
function foundation_login_stylesheet() {
  wp_enqueue_style( 'foundation-login', get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/wordpress/login.css' );
}
endif;
add_action( 'login_enqueue_scripts', 'foundation_login_stylesheet' );
