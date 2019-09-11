# wordpress-foundation

> Starter WordPress theme with ZURB Foundation & Elementor integration.

## Installation

1. Clone/download wordpress-foundation into the theme directory.
2. Install [gulp-foundation](https://github.com/bmarshall511/gulp-foundation) in the new theme.
3. Start developing.

## Development

This starter theme was developed with performance and optimization in mind. Rather than load everything, it allows developers to boost performance by loading only what the theme & individual components need. There's two ways to load Foundation components into the theme:

### Registered Foundation Scripts

These scripts can be called normally with [wp_enqueue_style](https://developer.wordpress.org/reference/functions/wp_enqueue_style/) and [wp_enqueue_script] (https://developer.wordpress.org/reference/functions/wp_enqueue_script/) within themes or plugins as needed:

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

1. [Akismet Anti-Spam](https://wordpress.org/plugins/akismet/) - Security
2. [Autoptimize](https://wordpress.org/plugins/autoptimize/) - Optimazation
3. [Broken Link Checker](https://wordpress.org/plugins/broken-link-checker/) - SEO
4. [Elementor Page Builder](https://wordpress.org/plugins/elementor/) - Features
5. [Google Analytics for WordPress by MonsterInsights](https://wordpress.org/plugins/google-analytics-for-wordpress/) - Analytics
6. [Jetpack by WordPress.com](https://wordpress.org/plugins/jetpack/) - Optimazation &amp; features
7. [Redirection](https://wordpress.org/plugins/redirection/) - SEO
8. [Regenerate Thumbnails](https://wordpress.org/plugins/regenerate-thumbnails/) - Features
9. [Smush Image Compression and Optimization](https://wordpress.org/plugins/wp-smushit/) - Optimazation
10. [SVG Support](https://wordpress.org/plugins/svg-support/) - Features
11. [Wordfence Security – Firewall & Malware Scan](https://wordpress.org/plugins/wordfence/) - Security
12. [WordPress SEO by Yoast](https://wordpress.org/plugins/wordpress-seo/) - SEO
13. [WP Mail SMTP by WPForms](https://wordpress.org/plugins/wp-mail-smtp/) - Features
14. [WP-Optimize](https://wordpress.org/plugins/wp-optimize/) - Optimazation
