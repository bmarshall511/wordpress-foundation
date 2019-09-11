# wordpress-foundation

> Starter WordPress theme with ZURB Foundation & Elementor integration.

## Installation

1. Clone/download wordpress-foundation into the theme directory.
2. Install [gulp-foundation](https://github.com/bmarshall511/gulp-foundation) in the new theme.
3. Start developing.

## Development with Elementor &mdash; only use it if you absolutely need it!

**Are you planning on using [Elementor](https://elementor.com/)?** There's pros and cons to using any page builders including Elementor &mdash; though if using a page builder, Elementor is definitely the way to go. wordpress-foundation supports Elementor & has an optional [Elementor Foundation plugin](https://github.com/bmarshall511/elementor-foundation) that provides some Foundation components as Elementor widgets.

**If you're looking to optimize to the nth-degree for performance, avoid using page builders.** Otherwise, there's a few things to note when using Elementor with this framework:

1. Foundation variables are seperate from Elementor global settings like 'Default Colors', 'Default Fonts' and the 'Color Picker'. It's still a good idea to set the Foundation variables to match your theme as some will be used and be inherited by Elementor widgets like headline, paragraph &amp; other basic element specifications.
2. Many of the Foundation components & variables aren't needed when using the Elementor editor due to it's abiliy to configure each element like Foundation's button component.
3. You can still use any of Foundation's components in conjuction with Elementor's widgets when needed.

## Theme Development

This starter theme was developed with performance and optimization in mind. Rather than load everything, it allows developers to boost performance by loading only what the theme & individual components need. There's two ways to load Foundation components into the theme:

### Registered Foundation Scripts

These scripts can be called normally with [wp_enqueue_style](https://developer.wordpress.org/reference/functions/wp_enqueue_style/) and [wp_enqueue_script](https://developer.wordpress.org/reference/functions/wp_enqueue_script/) within themes or plugins as needed:

#### Registered Foundation JavaScript Libraries

- foundation-core
- foundation-util-mediaQuery
- foundation-util-keyboard
- foundation-util-box
- foundation-util-triggers
- foundation-util-touch
- foundation-util-motion
- foundation-util-imageloader
- foundation-util-nest
- foundation-util-timer
- foundation-offcanvas
- foundation-tooltip
- foundation-reveal
- foundation-tabs
- foundation-toggler
- foundation-dropdown-menu
- foundation-sticky
- foundation-abide
- foundation-smooth-scroll
- foundation-magellan
- foundation-accordion-menu
- foundation-slider
- foundation-dropdown
- foundation-accordion
- foundation-orbit

#### Registered Foundation CSS Libraries

- foundation-offcanvas
- foundation-tooltip
- foundation-reveal
- foundation-tabs
- foundation-drilldown
- foundation-dropdown-menu
- foundation-sticky
- foundation-accordion-menu
- foundation-xy-grid
- foundation-callout
- foundation-close-button
- foundation-visibility
- foundation-forms
- foundation-flex
- foundation-button
- foundation-button-group
- foundation-label
- foundation-progress-bar
- foundation-slider
- foundation-switch
- foundation-table
- foundation-badge
- foundation-breadcrumbs
- foundation-card
- foundation-dropdown
- foundation-pagination
- foundation-accordion
- foundation-media-object
- foundation-orbit
- foundation-responsive-embed
- foundation-thumbnail
- foundation-menu
- foundation-menu-icon
- foundation-float
- foundation-prototype
- foundation-top-bar
- foundation-motion-ui

### Foundation Theme Libraries

The other way to easily load scripts needed into your theme or plugins is by calling predefined libraries which include all needed CSS and JavaScript files using `foundation_load_library( $library )`. The following are a list of available Foundation libraries:

- foundation-core
- foundation-util-mediaQuery
- foundation-util-keyboard
- foundation-util-box
- foundation-util-triggers
- foundation-util-touch
- foundation-util-motion
- foundation-util-imageloader
- foundation-util-nest
- foundation-offcanvas
- foundation-tooltip
- foundation-reveal
- foundation-tabs
- foundation-drilldown
- foundation-toggler
- foundation-dropdown-menu
- foundation-sticky
- foundation-abide
- foundation-smooth-scroll
- foundation-magellan
- foundation-accordion-menu
- foundation-xy-grid
- foundation-callout
- foundation-close-button
- foundation-visibility
- foundation-forms
- foundation-flex
- foundation-button
- foundation-button-group
- foundation-label
- foundation-progress-bar
- foundation-slider
- foundation-switch
- foundation-table
- foundation-badge
- foundation-breadcrumbs
- foundation-card
- foundation-dropdown
- foundation-pagination
- foundation-accordion
- foundation-media-object
- foundation-orbit
- foundation-responsive-embed
- foundation-thumbnail
- foundation-menu
- foundation-menu-icon
- foundation-float
- foundation-prototype
- foundation-top-bar
- foundation-motion-ui

## Recommend Plugins

The following plugins can be optionally automatically installed through this theme.

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
