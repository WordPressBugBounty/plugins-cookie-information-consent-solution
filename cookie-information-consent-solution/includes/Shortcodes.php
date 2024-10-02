<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\Elementor\Element;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Shortcodes' ) ) {
    class Shortcodes { use Singleton;
        private const SCRIPT = 'CookiePolicy';

        protected function __construct() { Plugin::hook( $this ); }

        #[ Action( 'init' ) ]
        public function register() : void {
            \add_shortcode( 'cookiepolicy', [ $this, 'cookiepolicy' ] ); // Backward compatibility
            \add_shortcode( 'privacycontrols', [ $this, 'privacycontrols' ] ); // Backward compatibility
            \add_shortcode( Plugin::getPrefix() . 'cookiepolicy', [ $this, 'cookiepolicy' ] );
            \add_shortcode( Plugin::getPrefix() . 'privacycontrols', [ $this, 'privacycontrols' ] );
        }

        public function cookiepolicy() : string {
            return (string) new Element( 'script', [
                'id' => self::SCRIPT,
                'src' => 'https://policy.app.cookieinformation.com/cid.js',
                'data-culture' => Language::get(),
                'type' => 'text/javascript'
            ], '' );
        }

        public function privacycontrols() : string {
            return (string) new Element( 'div', [ 'id' => 'cicc-template' ], '' );
        }
    }
}