<?php
/**
 * Foundation CSS & JS scripts
 *
 * Contains all Foundation component scripts.
 *
 * @package WordPress
 * @subpackage Foundation
 * @since 1.0
 */

class Foundation_Scripts {
  private $version = '6.5.3';
  public $libraries = array();

  public function __construct() {
    // Global Styles (https://foundation.zurb.com/sites/docs/global.html)
    $this->libraries['foundation-global-styles'] = array(
      'name'        => 'Foundation Global Styles',
      'recommended' => true,
      'type'        => 'css',
      'component'   => true,
      'url'         => 'https://foundation.zurb.com/sites/docs/global.html',
      'css' => array(
        'foundation-global-styles' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/global-styles.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Typography (https://foundation.zurb.com/sites/docs/typography-base.html)
    $this->libraries['foundation-typography'] = array(
      'name'        => 'Foundation Typography',
      'recommended' => true,
      'type'        => 'css',
      'component'   => true,
      'url'         => 'https://foundation.zurb.com/sites/docs/typography-base.html',
      'css' => array(
        'foundation-typography' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/typography.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Off-canvas (https://foundation.zurb.com/sites/docs/off-canvas.html)
    $this->libraries['foundation-offcanvas'] = array(
      'name'      => 'Foundation Off-canvas',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/off-canvas.html',
      'css' => array(
        'foundation-offcanvas' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/off-canvas.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-offcanvas' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.offcanvas.js',
          'dep'       => array( 'foundation-util-mediaQuery', 'foundation-util-keyboard', 'foundation-util-triggers' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Tooltip (https://foundation.zurb.com/sites/docs/tooltip.html)
    $this->libraries['foundation-tooltip'] = array(
      'name'      => 'Foundation Tooltip',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/tooltip.html',
      'css' => array(
        'foundation-tooltip' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/tooltip.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-tooltip' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.tooltip.js',
          'dep'       => array( 'foundation-util-box', 'foundation-util-mediaQuery', 'foundation-util-triggers' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Core (https://foundation.zurb.com/sites/docs/javascript.html)
    $this->libraries['foundation-core'] = array(
      'name'      => 'Foundation Core',
      'type'      => 'js',
      'component' => false,
      'js' => array(
        'foundation-core' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.core.js',
          'dep'       => array( 'jquery' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Media Queries (https://foundation.zurb.com/sites/docs/media-queries.html)
    $this->libraries['foundation-util-mediaQuery'] = array(
      'name'      => 'Foundation Media Queries',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/media-queries.html',
      'js' => array(
        'foundation-util-mediaQuery' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.mediaQuery.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Keyboard (https://foundation.zurb.com/sites/docs/javascript-utilities.html#keyboard)
    $this->libraries['foundation-util-keyboard'] = array(
      'name'      => 'Foundation Keyboard',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#keyboard',
      'js' => array(
        'foundation-util-keyboard' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.keyboard.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Box (https://foundation.zurb.com/sites/docs/javascript-utilities.html#box)
    $this->libraries['foundation-util-box'] = array(
      'name'      => 'Foundation Box',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#box',
      'js' => array(
        'foundation-util-box' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.box.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Triggers (https://foundation.zurb.com/sites/docs/javascript-utilities.html#triggers)
    $this->libraries['foundation-util-triggers'] = array(
      'name'      => 'Foundation Triggers',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#triggers',
      'js' => array(
        'foundation-util-triggers' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.triggers.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Touch (https://foundation.zurb.com/sites/docs/javascript-utilities.html#touch)
    $this->libraries['foundation-util-touch'] = array(
      'name'      => 'Foundation Touch',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#touch',
      'js' => array(
        'foundation-util-touch' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.touch.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Motion (https://foundation.zurb.com/sites/docs/javascript-utilities.html#motion-move)
    $this->libraries['foundation-util-motion'] = array(
      'name'      => 'Foundation Motion/Move',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#motion-move',
      'js' => array(
        'foundation-util-motion' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.motion.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Timer (https://foundation.zurb.com/sites/docs/javascript-utilities.html#timer)
    $this->libraries['foundation-util-timer'] = array(
      'name'      => 'Foundation Timer',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#timer',
      'js' => array(
        'foundation-util-timer' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.timer.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Image Loader (https://foundation.zurb.com/sites/docs/javascript-utilities.html#imageloader)
    $this->libraries['foundation-util-imageloader'] = array(
      'name'      => 'Foundation Image Loader',
      'type'      => 'js',
      'component' => false,
      'url'       => 'https://foundation.zurb.com/sites/docs/javascript-utilities.html#imageloader',
      'js' => array(
        'foundation-util-imageloader' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.imageLoader.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Nest
    $this->libraries['foundation-util-nest'] = array(
      'name'      => 'Foundation Nest',
      'type'      => 'js',
      'component' => false,
      'js' => array(
        'foundation-util-nest' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.util.nest.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Reveal (https://foundation.zurb.com/sites/docs/reveal.html)
    $this->libraries['foundation-reveal'] = array(
      'name'      => 'Foundation Reveal',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/reveal.html',
      'css' => array(
        'foundation-reveal' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/reveal.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-reveal' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.reveal.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-touch', 'foundation-util-triggers', 'foundation-util-mediaQuery', 'foundation-util-motion' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Tabs (https://foundation.zurb.com/sites/docs/tabs.html)
    $this->libraries['foundation-tabs'] = array(
      'name'      => 'Foundation Tabs',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/tabs.html',
      'css' => array(
        'foundation-tabs' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/tabs.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-tabs' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.tabs.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-imageloader' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Drilldown (https://foundation.zurb.com/sites/docs/drilldown-menu.html)
    $this->libraries['foundation-drilldown'] = array(
      'name'      => 'Foundation Drilldown Menu',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/drilldown-menu.html',
      'css' => array(
        'foundation-drilldown' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/drilldown-menu.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-drilldown' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.drilldown.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-nest', 'foundation-util-box' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Toggler (https://foundation.zurb.com/sites/docs/toggler.html)
    $this->libraries['foundation-toggler'] = array(
      'name'      => 'Foundation Toggler',
      'type'      => 'js',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/toggler.html',
      'js' => array(
        'foundation-toggler' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.toggler.js',
          'dep'       => array( 'foundation-util-motion', 'foundation-util-triggers' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Dropdown Menu (https://foundation.zurb.com/sites/docs/dropdown-menu.html)
    $this->libraries['foundation-dropdown-menu'] = array(
      'name'      => 'Foundation Dropdown Menu',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/dropdown-menu.html',
      'css' => array(
        'foundation-dropdown-menu' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/dropdown-menu.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-dropdown-menu' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.dropdownMenu.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-box', 'foundation-util-nest', 'foundation-util-touch' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Dropdown (https://foundation.zurb.com/sites/docs/dropdown.html)
    $this->libraries['foundation-dropdown'] = array(
      'name'      => 'Foundation Dropdown',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/dropdown.html',
      'css' => array(
        'foundation-dropdown' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/dropdown.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-dropdown' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.dropdown.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-box', 'foundation-util-touch', 'foundation-util-triggers' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Sticky (https://foundation.zurb.com/sites/docs/sticky.html)
    $this->libraries['foundation-sticky'] = array(
      'name'      => 'Foundation Sticky',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/sticky.html',
      'css' => array(
        'foundation-sticky' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/sticky.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-sticky' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.sticky.js',
          'dep'       => array( 'foundation-util-triggers', 'foundation-util-mediaQuery' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Abide (https://foundation.zurb.com/sites/docs/abide.html)
    $this->libraries['foundation-abide'] = array(
      'name'      => 'Foundation Abide',
      'type'      => 'js',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/abide.html',
      'js' => array(
        'foundation-abide' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.abide.js',
          'dep'       => array(),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Smooth Scroll (https://foundation.zurb.com/sites/docs/smooth-scroll.html)
    $this->libraries['foundation-smooth-scroll'] = array(
      'name'      => 'Foundation Smooth Scroll',
      'type'      => 'js',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/smooth-scroll.html',
      'js' => array(
        'foundation-smooth-scroll' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.smoothScroll.js',
          'dep'       => array(),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Magellan (https://foundation.zurb.com/sites/docs/magellan.html)
    $this->libraries['foundation-magellan'] = array(
      'name'      => 'Foundation Magellan',
      'type'      => 'js',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/magellan.html',
      'js' => array(
        'foundation-magellan' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.magellan.js',
          'dep'       => array( 'foundation-smooth-scroll', 'foundation-util-triggers' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Accordion Menu (https://foundation.zurb.com/sites/docs/accordion-menu.html)
    $this->libraries['foundation-accordion-menu'] = array(
      'name'      => 'Foundation Accordion Menu',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/accordion-menu.html',
      'css' => array(
        'foundation-accordion-menu' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/accordion-menu.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-accordion-menu' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.accordionMenu.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-nest' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation XY Grid (https://foundation.zurb.com/sites/docs/xy-grid.html)
    $this->libraries['foundation-xy-grid'] = array(
      'name'      => 'Foundation XY Grid',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/xy-grid.html',
      'css' => array(
        'foundation-xy-grid' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/xy-grid-classes.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Callout (https://foundation.zurb.com/sites/docs/callout.html)
    $this->libraries['foundation-callout'] = array(
      'name'      => 'Foundation Callout',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/callout.html',
      'css' => array(
        'foundation-callout' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/callout.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Close Button (https://foundation.zurb.com/sites/docs/close-button.html)
    $this->libraries['foundation-close-button'] = array(
      'name'      => 'Foundation Close Button',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/close-button.html',
      'css' => array(
        'foundation-close-button' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/close-button.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Visibility Classes (https://foundation.zurb.com/sites/docs/visibility.html)
    $this->libraries['foundation-visibility'] = array(
      'name'      => 'Foundation Visibility Classes',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/visibility.html',
      'css' => array(
        'foundation-visibility' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/visibility.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Forms (https://foundation.zurb.com/sites/docs/forms.html)
    $this->libraries['foundation-forms'] = array(
      'name'      => 'Foundation Forms',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/forms.html',
      'css' => array(
        'foundation-forms' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/forms.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Flex (https://foundation.zurb.com/sites/docs/flexbox-utilities.html)
    $this->libraries['foundation-flex'] = array(
      'name'      => 'Foundation Flex Classes',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/flexbox-utilities.html',
      'css' => array(
        'foundation-flex' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/flex.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Button (https://foundation.zurb.com/sites/docs/button.html)
    $this->libraries['foundation-button'] = array(
      'name'      => 'Foundation Button',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/button.html',
      'css' => array(
        'foundation-button' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/button.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Button Group (https://foundation.zurb.com/sites/docs/button-group.html)
    $this->libraries['foundation-button-group'] = array(
      'name'      => 'Foundation Button Group',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/button-group.html',
      'css' => array(
        'foundation-button-group' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/button-group.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Label (https://foundation.zurb.com/sites/docs/label.html)
    $this->libraries['foundation-label'] = array(
      'name'      => 'Foundation Label',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/label.html',
      'css' => array(
        'foundation-label' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/label.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Progress Bar (https://foundation.zurb.com/sites/docs/progress-bar.html)
    $this->libraries['foundation-progress-bar'] = array(
      'name'      => 'Foundation Progress Bar',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/progress-bar.html',
      'css' => array(
        'foundation-progress-bar' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/progress-bar.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Slider (https://foundation.zurb.com/sites/docs/slider.html)
    $this->libraries['foundation-slider'] = array(
      'name'      => 'Foundation Slider',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/slider.html',
      'css' => array(
        'foundation-slider' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/slider.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-slider' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.slider.js',
          'dep'       => array( 'foundation-util-motion', 'foundation-util-triggers', 'foundation-util-keyboard', 'foundation-util-touch' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Switch (https://foundation.zurb.com/sites/docs/switch.html)
    $this->libraries['foundation-switch'] = array(
      'name'      => 'Foundation Switch',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/switch.html',
      'css' => array(
        'foundation-progress-bar' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/switch.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Table (https://foundation.zurb.com/sites/docs/table.html)
    $this->libraries['foundation-table'] = array(
      'name'      => 'Foundation Table',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/table.html',
      'css' => array(
        'foundation-table' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/table.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Badge (https://foundation.zurb.com/sites/docs/badge.html)
    $this->libraries['foundation-badge'] = array(
      'name'      => 'Foundation Badge',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/badge.html',
      'css' => array(
        'foundation-badge' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/badge.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Breadcrumbs (https://foundation.zurb.com/sites/docs/breadcrumbs.html)
    $this->libraries['foundation-breadcrumbs'] = array(
      'name'      => 'Foundation Breadcrumbs',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/breadcrumbs.html',
      'css' => array(
        'foundation-breadcrumbs' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/breadcrumbs.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Card (https://foundation.zurb.com/sites/docs/card.html)
    $this->libraries['foundation-card'] = array(
      'name'      => 'Foundation Card',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/card.html',
      'css' => array(
        'foundation-card' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/card.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Pagination (https://foundation.zurb.com/sites/docs/pagination.html)
    $this->libraries['foundation-pagination'] = array(
      'name'      => 'Foundation Pagination',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/pagination.html',
      'css' => array(
        'foundation-pagination' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/pagination.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Accordion (https://foundation.zurb.com/sites/docs/accordion.html)
    $this->libraries['foundation-accordion'] = array(
      'name'      => 'Foundation Accordion',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/accordion.html',
      'css' => array(
        'foundation-accordion' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/accordion.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-accordion' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.accordion.js',
          'dep'       => array( 'foundation-util-keyboard' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Media Object (https://foundation.zurb.com/sites/docs/media-object.html)
    $this->libraries['foundation-media-object'] = array(
      'name'      => 'Foundation Media Object',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/media-object.html',
      'css' => array(
        'foundation-media-object' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/media-object.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Orbit (https://foundation.zurb.com/sites/docs/orbit.html)
    $this->libraries['foundation-orbit'] = array(
      'name'      => 'Foundation Orbit',
      'type'      => 'bundle',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/orbit.html',
      'css' => array(
        'foundation-orbit' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/orbit.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-orbit' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/js/foundation/foundation.orbit.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-motion', 'foundation-util-timer', 'foundation-util-imageloader', 'foundation-util-touch' ),
          'version'   => $this->version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Responsive Embed (https://foundation.zurb.com/sites/docs/responsive-embed.html)
    $this->libraries['foundation-responsive-embed'] = array(
      'name'      => 'Foundation Responsive Embed',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/responsive-embed.html',
      'css' => array(
        'foundation-responsive-embed' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/responsive-embed.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Thumbnail (https://foundation.zurb.com/sites/docs/thumbnail.html)
    $this->libraries['foundation-thumbnail'] = array(
      'name'      => 'Foundation Thumbnail',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/thumbnail.html',
      'css' => array(
        'foundation-thumbnail' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/thumbnail.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Menu (https://foundation.zurb.com/sites/docs/menu.html)
    $this->libraries['foundation-menu'] = array(
      'name'      => 'Foundation Menu',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/menu.html',
      'css' => array(
        'foundation-menu' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/menu.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Foundation Menu Icon (https://foundation.zurb.com/sites/docs/menu.html)
    $this->libraries['foundation-menu-icon'] = array(
      'name'      => 'Foundation Menu Icon',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/menu.html',
      'css' => array(
        'foundation-menu-icon' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/menu-icon.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Float Classes (https://foundation.zurb.com/sites/docs/float-classes.html)
    $this->libraries['foundation-float'] = array(
      'name'      => 'Foundation Float Classes',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/float-classes.html',
      'css' => array(
        'foundation-float' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/float.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Prototype Classes (https://foundation.zurb.com/sites/docs/prototyping-utilities.html)
    $this->libraries['foundation-prototype'] = array(
      'name'      => 'Foundation Prototype Classes',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/prototyping-utilities.html',
      'css' => array(
        'foundation-prototype' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/prototype.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Top Bar (https://foundation.zurb.com/sites/docs/top-bar.html)
    $this->libraries['foundation-top-bar'] = array(
      'name'      => 'Foundation Top Bar',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/top-bar.html',
      'css' => array(
        'foundation-top-bar' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/top-bar.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    // Motion UI (https://foundation.zurb.com/sites/docs/motion-ui.html)
    $this->libraries['foundation-motion-ui'] = array(
      'name'      => 'Foundation Motion UI',
      'type'      => 'css',
      'component' => true,
      'url'       => 'https://foundation.zurb.com/sites/docs/motion-ui.html',
      'css' => array(
        'foundation-motion-ui' => array(
          'src'       => get_stylesheet_directory_uri() . '/' . FOUNDATION_ASSETS . '/css/foundation/foundation-motion-ui.css',
          'dep'       => array(),
          'version'   => $this->version,
          'media'     => 'all',
        ),
      ),
    );

    add_action( 'wp_enqueue_scripts', array( $this, 'wp_register_scripts' ) );
  }

  /**
   * Register libraries with WordPress
   */
  public function wp_register_scripts() {
    foreach( $this->libraries as $library => $scripts ) {
      // JavaScript
      if ( ! empty( $scripts['js'] ) ) {
        foreach( $scripts['js'] as $handle => $js ) {
          wp_register_script( $handle, $js['src'], $js['dep'], $js['version'], $js['in_footer'] );
        }
      }

      // CSS
      if ( ! empty( $scripts['css'] ) ) {
        foreach( $scripts['css'] as $handle => $css ) {
          wp_register_style( $handle, $css['src'], $css['dep'], $css['version'], $css['media'] );
        }
      }
    }

    if ( function_exists( 'get_field' ) ) {

      // Auto-load Foundation libraries
      $foundation_libraries = get_field( 'autoload_foundation_libraries', 'option' );
      if ( $foundation_libraries ) {
        foreach( $foundation_libraries as $key => $library ) {
          $this->load_library( $library );
        }
      }
    }
  }

  /**
   * Loads a pre-defined library
   */
  public function load_library( $library ) {
    // JavaScript
    if ( ! empty( $this->libraries[$library]['js'] ) ) {
      foreach( $this->libraries[$library]['js'] as $handle => $js ) {
        wp_enqueue_script( $handle );
      }
    }

    // CSS
    if ( ! empty( $this->libraries[$library]['css'] ) ) {
      foreach( $this->libraries[$library]['css'] as $handle => $css ) {
        wp_enqueue_style( $handle );
      }
    }
  }
}

$Foundation_Scripts = new Foundation_Scripts();

function foundation_load_library( $library ) {
  global $Foundation_Scripts;

  $Foundation_Scripts->load_library( $library );
}