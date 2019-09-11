<?php
/**
 * Elementor
 *
 * Elementor functionality, overrides, filters, actions, etc.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 * @version 2.0.0
 */

/**
 * Async Elementor generated CSS files
 */
function foundation_style_loader_tag($tag){
  $tag = preg_replace( "/rel='stylesheet' id='elementor/", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\" id='elementor", $tag );

	$tag = preg_replace( "/rel='stylesheet' id='google-fonts/", "rel='preload' as='style' onload=\"this.onload=null;this.rel='stylesheet'\" id='google-fonts", $tag );

	return $tag;
}
add_filter( 'style_loader_tag', 'foundation_style_loader_tag' );