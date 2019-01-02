<?php
/**
 * Foundation: Customizer
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 * @version 2.0.0
 */

 /**
  * Add postMessage support for site title and description for the Theme Customizer.
  *
  * @param WP_Customize_Manager $wp_customize Theme Customizer object.
  */
 function foundation_customize_register( $wp_customize ) {
 	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
 	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
 	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

 	if ( isset( $wp_customize->selective_refresh ) ) {
 		$wp_customize->selective_refresh->add_partial(
 			'blogname',
 			array(
 				'selector'        => '.site-title a',
 				'render_callback' => 'foundation_customize_partial_blogname',
 			)
 		);
 		$wp_customize->selective_refresh->add_partial(
 			'blogdescription',
 			array(
 				'selector'        => '.site-description',
 				'render_callback' => 'foundation_customize_partial_blogdescription',
 			)
 		);
 	}
 }
 add_action( 'customize_register', 'foundation_customize_register' );

 /**
  * Render the site title for the selective refresh partial.
  *
  * @return void
  */
 function foundation_customize_partial_blogname() {
 	bloginfo( 'name' );
 }

 /**
  * Render the site tagline for the selective refresh partial.
  *
  * @return void
  */
 function foundation_customize_partial_blogdescription() {
 	bloginfo( 'description' );
 }

 /**
  * Sanitize toggle choice.
  *
  * @param string $choice Whether off-canvas is active.
  *
  * @return string
  */
 function foundation_sanitize_toggle( $choice ) {
 	$valid = array(
 		'enabled',
 		'disabled',
 	);

 	if ( in_array( $choice, $valid, true ) ) {
 		return $choice;
 	}

 	return 'enabled';
 }
