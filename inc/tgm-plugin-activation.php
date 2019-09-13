<?php
/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/classes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'foundation_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 */
function foundation_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'        => 'WordPress SEO by Yoast',
			'slug'        => 'wordpress-seo',
			'is_callable' => 'wpseo_init',
		),

    array(
			'name'        => 'Akismet Anti-Spam',
			'slug'        => 'akismet',
		),

    array(
			'name'        => 'Jetpack by WordPress.com',
			'slug'        => 'jetpack',
		),

    array(
			'name'        => 'Wordfence Security – Firewall & Malware Scan',
			'slug'        => 'wordfence',
		),

    array(
			'name'        => 'Google Analytics for WordPress by MonsterInsights',
			'slug'        => 'google-analytics-for-wordpress',
		),

    array(
			'name'        => 'Regenerate Thumbnails',
			'slug'        => 'regenerate-thumbnails',
		),

    array(
			'name'        => 'Elementor Page Builder',
			'slug'        => 'elementor',
		),

    array(
			'name'        => 'Smush Image Compression and Optimization',
			'slug'        => 'wp-smushit',
		),

    array(
			'name'        => 'Redirection',
			'slug'        => 'redirection',
		),

    array(
			'name'        => 'WP Mail SMTP by WPForms',
			'slug'        => 'wp-mail-smtp',
		),

    array(
			'name'        => 'WP-Optimize',
			'slug'        => 'wp-optimize',
		),

    array(
			'name'        => 'Autoptimize',
			'slug'        => 'autoptimize',
		),

    array(
			'name'        => 'Broken Link Checker',
			'slug'        => 'broken-link-checker',
		),

    array(
			'name'        => 'SVG Support',
			'slug'        => 'svg-support',
		),

		array(
			'name'        => 'Widget CSS Classes',
			'slug'        => 'widget-css-classes',
		),

		array(
			'name'        => 'Nextend Social Login',
			'slug'        => 'nextend-facebook-connect',
    ),

    array(
			'name'        => 'SG Optimizer',
			'slug'        => 'sg-cachepress',
    ),

    array(
			'name'        => 'Advanced Custom Fields',
      'slug'        => 'advanced-custom-fields',
      'is_callable' => 'acf',
    ),

    array(
			'name'        => 'Super Progressive Web Apps',
      'slug'        => 'super-progressive-web-apps',
    ),

    array(
			'name'        => 'WPS Hide Login',
      'slug'        => 'wps-hide-login',
    ),

    array(
			'name'        => 'Custom Post Type UI',
      'slug'        => 'custom-post-type-ui',
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'foundation',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'foundation' ),
			'menu_title'                      => __( 'Install Plugins', 'foundation' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'foundation' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'foundation' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'foundation' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'foundation'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'foundation'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'foundation'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'foundation'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'foundation'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'foundation'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'foundation'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'foundation'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'foundation'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'foundation' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'foundation' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'foundation' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'foundation' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'foundation' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'foundation' ),
			'dismiss'                         => __( 'Dismiss this notice', 'foundation' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'foundation' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'foundation' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
