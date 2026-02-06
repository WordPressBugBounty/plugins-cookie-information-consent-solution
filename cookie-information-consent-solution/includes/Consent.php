<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Consent' ) ) {
    class Consent { use Singleton;
        protected function __construct() { Plugin::hook( $this ); }

        #[ Action( 'wp_enqueue_scripts' ) ]
        public function scripts() : void {
            if( ! \is_plugin_active( 'wp-consent-api/wp-consent-api.php' ) ) return;

            \wp_register_script( Plugin::getSlug() . '-consent', Plugin::getUrl() . '/assets/scripts/consent.js', [ 'wp-consent-api', Popup::SCRIPT ], Plugin::getVersion() );
            \wp_enqueue_script( Plugin::getSlug() . '-consent' );
        }
    }
}