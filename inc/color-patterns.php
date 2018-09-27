<?php
/**
 * Foundation: Color Patterns
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 */

/**
 * Generate the CSS for the current custom color scheme.
 */
function foundation_custom_colors_css() {
  // 1 = Primary
  // 2 = Secondary
  // 3 = Text
  // 4 = Accent
  $color_scheme = get_option( 'elementor_scheme_color' );

	$css                = '
/**
 * Foundation: Color Patterns
 */

';

	/**
	 * Filters Foundation custom colors CSS.
	 *
	 * @since Foundation 1.0
	 *
	 * @param string $css        Base theme colors CSS.
	 */
	return apply_filters( 'foundation_custom_colors_css', $css );
}
