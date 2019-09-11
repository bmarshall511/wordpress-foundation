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
    // Foundation Core (https://foundation.zurb.com/sites/docs/javascript.html)
    $this->libraries['foundation-core'] = array(
      'js' => array(
        'foundation-core' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.core.js',
          'dep'       => array( 'jquery' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Media Queries (https://foundation.zurb.com/sites/docs/media-queries.html)
    $this->libraries['foundation-util-mediaQuery'] = array(
      'js' => array(
        'foundation-util-mediaQuery' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.mediaQuery.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Keyboard (https://foundation.zurb.com/sites/docs/javascript-utilities.html#keyboard)
    $this->libraries['foundation-util-keyboard'] = array(
      'js' => array(
        'foundation-util-keyboard' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.keyboard.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Box (https://foundation.zurb.com/sites/docs/javascript-utilities.html#box)
    $this->libraries['foundation-util-box'] = array(
      'js' => array(
        'foundation-util-box' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.box.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Triggers (https://foundation.zurb.com/sites/docs/javascript-utilities.html#triggers)
    $this->libraries['foundation-util-triggers'] = array(
      'js' => array(
        'foundation-util-triggers' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.triggers.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Touch (https://foundation.zurb.com/sites/docs/javascript-utilities.html#touch)
    $this->libraries['foundation-util-touch'] = array(
      'js' => array(
        'foundation-util-touch' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.touch.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Motion (https://foundation.zurb.com/sites/docs/javascript-utilities.html#motion-move)
    $this->libraries['foundation-util-motion'] = array(
      'js' => array(
        'foundation-util-motion' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.motion.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Image Loader (https://foundation.zurb.com/sites/docs/javascript-utilities.html#imageloader)
    $this->libraries['foundation-util-imageloader'] = array(
      'js' => array(
        'foundation-util-imageloader' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.imageLoader.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Nest
    $this->libraries['foundation-util-nest'] = array(
      'js' => array(
        'foundation-util-nest' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.util.nest.js',
          'dep'       => array( 'foundation-core' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Off-canvas (https://foundation.zurb.com/sites/docs/off-canvas.html)
    $this->libraries['foundation-offcanvas'] = array(
      'css' => array(
        'foundation-offcanvas' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/off-canvas.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-offcanvas' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.offcanvas.js',
          'dep'       => array( 'foundation-util-mediaQuery', 'foundation-util-keyboard', 'foundation-util-triggers' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Tooltip (https://foundation.zurb.com/sites/docs/tooltip.html)
    $this->libraries['foundation-tooltip'] = array(
      'css' => array(
        'foundation-tooltip' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/tooltip.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-tooltip' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.tooltip.js',
          'dep'       => array( 'foundation-util-box', 'foundation-util-mediaQuery', 'foundation-util-triggers' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Reveal (https://foundation.zurb.com/sites/docs/reveal.html)
    $this->libraries['foundation-reveal'] = array(
      'css' => array(
        'foundation-reveal' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/reveal.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-reveal' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.reveal.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-touch', 'foundation-util-triggers', 'foundation-util-mediaQuery', 'foundation-util-motion' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Tabs (https://foundation.zurb.com/sites/docs/tabs.html)
    $this->libraries['foundation-tabs'] = array(
      'css' => array(
        'foundation-tabs' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/tabs.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-tabs' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.tabs.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-imageloader' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Drilldown (https://foundation.zurb.com/sites/docs/drilldown-menu.html)
    $this->libraries['foundation-drilldown'] = array(
      'css' => array(
        'foundation-drilldown' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/drilldown-menu.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-drilldown' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.drilldown.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-nest', 'foundation-util-box' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Toggler (https://foundation.zurb.com/sites/docs/toggler.html)
    $this->libraries['foundation-toggler'] = array(
      'js' => array(
        'foundation-toggler' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.toggler.js',
          'dep'       => array( 'foundation-util-motion', 'foundation-util-triggers' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Dropdown Menu (https://foundation.zurb.com/sites/docs/dropdown-menu.html)
    $this->libraries['foundation-dropdown-menu'] = array(
      'css' => array(
        'foundation-dropdown-menu' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/dropdown-menu.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-dropdown-menu' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.dropdownMenu.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-box', 'foundation-util-nest', 'foundation-util-touch' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Sticky (https://foundation.zurb.com/sites/docs/sticky.html)
    $this->libraries['foundation-sticky'] = array(
      'css' => array(
        'foundation-sticky' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/sticky.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-sticky' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.sticky.js',
          'dep'       => array( 'foundation-util-triggers', 'foundation-util-mediaQuery' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Abide (https://foundation.zurb.com/sites/docs/abide.html)
    $this->libraries['foundation-abide'] = array(
      'js' => array(
        'foundation-abide' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.abide.js',
          'dep'       => array(),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Smooth Scroll (https://foundation.zurb.com/sites/docs/smooth-scroll.html)
    $this->libraries['foundation-smooth-scroll'] = array(
      'js' => array(
        'foundation-smooth-scroll' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.smoothScroll.js',
          'dep'       => array(),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Magellan (https://foundation.zurb.com/sites/docs/magellan.html)
    $this->libraries['foundation-magellan'] = array(
      'js' => array(
        'foundation-magellan' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.magellan.js',
          'dep'       => array( 'foundation-smooth-scroll', 'foundation-util-triggers' ),
          'version'   => $this->$version,
          'in_footer' => true,
        ),
      ),
    );

    // Foundation Accordion Menu (https://foundation.zurb.com/sites/docs/accordion-menu.html)
    $this->libraries['foundation-accordion-menu'] = array(
      'css' => array(
        'foundation-accordion-menu' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/css/foundation/accordion-menu.css',
          'dep'       => array(),
          'version'   => $this->$version,
          'media'     => 'all',
        ),
      ),
      'js' => array(
        'foundation-accordion-menu' => array(
          'src'       => get_template_directory_uri() . '/' . ASSETS . '/js/foundation/foundation.accordionMenu.js',
          'dep'       => array( 'foundation-util-keyboard', 'foundation-util-nest' ),
          'version'   => $this->$version,
          'in_footer' => true,
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
      // CSS
      if ( ! empty( $scripts['css'] ) ) {
        foreach( $scripts['css'] as $handle => $css ) {
          wp_register_style( $handle, $css['src'], $css['dep'], $css['version'], $css['media'] );
        }
      }
    }
  }
}

$Foundation_Scripts = new Foundation_Scripts();