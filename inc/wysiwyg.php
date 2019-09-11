<?php
function foundation_wysiwyg_buttons( $buttons ) {
  array_unshift( $buttons, 'styleselect' );

	return $buttons;
}
add_filter( 'mce_buttons_2', 'foundation_wysiwyg_buttons' );

function foundation_wysiwyg_style_formats( $init_array ) {
	$style_formats = array(
		array(
			'title'   => '.lead',
			'block'   => 'p',
			'classes' => 'lead',
			'wrapper' => false,
		)
	);

	$init_array['style_formats'] = wp_json_encode( $style_formats );

	return $init_array;
}
add_filter( 'tiny_mce_before_init', 'foundation_wysiwyg_style_formats' );