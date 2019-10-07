# Foundation &mdash; Starter WordPress Theme

> Starter WordPress theme for developers to build incredible websites &mdash; built for performance with an average 100/100 Lighthouse score.

* Supports Gutenberg & TinyMCE
* Easily inline critical CSS for a boost in performance
* Supports [Elementor](https://elementor.com/)
* Optional [ZURB Foundation](https://foundation.zurb.com/) framework
* Both developer & non-developer friendly
* Average 100/100 [Lighthouse](https://developers.google.com/web/tools/lighthouse/) score
* No-bloat, use & load only what you need, built with performance & developers in mind
* Utilizes Node.js & Gulp to compile frontend assets using [gulp-foundation](https://github.com/bmarshall511/gulp-foundation)

## Installation

1. Clone/download wordpress-foundation into the theme directory.
2. **Optional, but recommended.** Create a [child theme](https://developer.wordpress.org/themes/advanced-topics/child-themes/). Using a child theme allows you to easily update Foundation when new releases are available.
2. Install [gulp-foundation](https://github.com/bmarshall511/gulp-foundation) in the theme directory. If you created a child theme, install it there.
3. Start developing.

## Development

### Development with [Elementor](https://elementor.com/)

There's pros and cons to using any page builder including Elementor &mdash; though if using a page builder, Elementor is definitely the way to go. **If you're looking to optimize to the nth-degree for performance, avoid using page builders including Elementor.**

Foundation supports Elementor & has an optional [Elementor Foundation plugin](https://github.com/bmarshall511/elementor-foundation) that provides some Foundation components as Elementor widgets. When using Foundation with Elementor, there's a few things to keep in mind:

1. Foundation variables are seperate from Elementor global settings like 'Default Colors', 'Default Fonts' and the 'Color Picker'. It's still a good idea to set the Foundation variables to match your theme as some will be used and be inherited by Elementor widgets like headline, paragraph &amp; other basic element specifications.
2. Many of the Foundation components & variables aren't needed when using the Elementor editor due to it's abiliy to configure each element like Foundation's button component.
3. You can still use any of Foundation's components in conjuction with Elementor's widgets when needed.

### Theme Development

This starter theme was developed with performance and optimization in mind. Rather than load everything, it allows developers to boost performance by loading only what the theme & individual components need. There's four ways to load Foundation components into the theme:

1. Via the normal [wp_enqueue_style](https://developer.wordpress.org/reference/functions/wp_enqueue_style/) and [wp_enqueue_script](https://developer.wordpress.org/reference/functions/wp_enqueue_script/) functions using the pre-registered scripts found in `inc/theme-scripts.php` and `inc/foundation-scripts.php`.
2. Via `foundation_load_library( $library )` and `foundation_load_theme_library( $library )` functions, where `$library` is one of the pre-defined Foundation/theme libraries found in `inc/theme-scripts.php` and `inc/foundation-scripts.php`.
3. Within the admin CMS, under 'Configuration' in the 'Foundation Libraries' and 'Theme Libraries' tab.
4. When using certain widgets and Elementor widgets that automatically call the library that's needed on demand.

#### Enqueuing Scripts

If using a child theme, it's important theme scripts are enqueued properly. To enqueue one of the predefined Foundation or theme scripts, set the `add_action` priority high so it's called after Foundation's scripts are registered:

```php
function theme_scripts() {
  // Loading libraries
  foundation_load_library( 'foundation-toggler' );
  foundation_load_library( 'foundation-abide' );

  foundation_load_theme_library( 'theme-core' );
  foundation_load_theme_library( 'wordpress-core' );

   // Enqueue vs. foundation_load_library. Useful if CSS is already included.
  wp_enqueue_script( 'foundation-sticky' );
}
add_action( 'wp_enqueue_scripts', 'theme_scripts', 99 );
```

#### Custom Libraries

You can easily add your own custom CSS & JS as libraries using `foundation_add_theme_library( $args )`:

```php
function customtheme_after_theme_setup() {
  // Returns the registered library, false if something went wrong.
  $custom_lib = foundation_add_theme_library(array(
    'id'          => 'custom', // Unique identifier
    'name'        => 'Custom Library', // Human-readable name
    'recommended' => true, // For display purposes on the Configuration page
    'component'   => true, // When true, displays as an auto-load option on the Configuration page
    'css'         => array(
      'custom-css' => array( // Unique identifier that can be used to load directly via wp_enqueue_style
        'src'     => FOUNDATION_ASSETS . '/css/custom.css',
        'dep'     => array(),
        'version' => wp_get_theme()->get( 'Version' ),
        'media'   => 'all',
      ),
    ),
    'js' => array(
      'custom-js' => array( // Unique identifier that can be used to load directly via wp_enqueue_script
        'src'       => FOUNDATION_ASSETS . '/js/custom.js',
        'dep'       => array( 'jquery' ),
        'version'   => wp_get_theme()->get( 'Version' ),
        'in_footer' => true,
      ),
    )
  ));
}
add_action( 'after_setup_theme', 'customtheme_after_theme_setup' );
```

## Recommend/Useful Plugins

The following plugins can be optionally &amp; automatically installed through this theme.

1. [Advanced Custom Fields](https://wordpress.org/plugins/advanced-custom-fields/) - Features
2. [Akismet Anti-Spam](https://wordpress.org/plugins/akismet/) - Security
3. [Autoptimize](https://wordpress.org/plugins/autoptimize/) - Optimazation
4. [Broken Link Checker](https://wordpress.org/plugins/broken-link-checker/) - SEO
5. [Elementor Page Builder](https://wordpress.org/plugins/elementor/) - Features
6. [Google Analytics for WordPress by MonsterInsights](https://wordpress.org/plugins/google-analytics-for-wordpress/) - Analytics
7. [Jetpack by WordPress.com](https://wordpress.org/plugins/jetpack/) - Optimazation &amp; features
8. [Redirection](https://wordpress.org/plugins/redirection/) - SEO
9. [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) - Features
10. [Smush Image Compression and Optimization](https://wordpress.org/plugins/wp-smushit/) - Optimazation
11. [SVG Support](https://wordpress.org/plugins/svg-support/) - Features
12. [Wordfence Security – Firewall & Malware Scan](https://wordpress.org/plugins/wordfence/) - Security
13. [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/) - SEO
14. [WP Mail SMTP by WPForms](https://wordpress.org/plugins/wp-mail-smtp/) - Features
15. [WP-Optimize](https://wordpress.org/plugins/wp-optimize/) - Optimazation
16. [Classic Editor](https://wordpress.org/plugins/classic-editor/) - User Preference
17. [Elementor Custom Skin](https://wordpress.org/plugins/ele-custom-skin/) - Features
18. [Super Progressive Web Apps](https://wordpress.org/plugins/super-progressive-web-apps/) - Optimazation & features
19. [SG Optimizer](https://wordpress.org/plugins/sg-cachepress/) - SiteGround Hosting Optimazation
20. [WPS Hide Login](https://wordpress.org/plugins/wps-hide-login/) - Security
