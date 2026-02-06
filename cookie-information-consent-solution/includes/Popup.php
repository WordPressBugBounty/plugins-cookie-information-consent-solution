<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Filter;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Popup' ) ) {
    class Popup { use Singleton;
        public const SCRIPT = 'CookieConsent';

        private Options $options;

        protected function __construct( Options $options ) {
            $this->options = $options;

            Plugin::hook( $this );
        }

        #[ Action( 'wp_enqueue_scripts' ) ]
        public function scripts() : void {
            if( ! $this->options->getPopup() ) return;

            \wp_register_script( self::SCRIPT, 'https://policy.app.cookieinformation.com/uc.js', [], null );
            \wp_enqueue_script( self::SCRIPT );

            if( $this->options->getGCM() ) \wp_add_inline_script( self::SCRIPT, self::gcm(), 'before' );
        }

        #[ Filter( 'wp_script_attributes' ) ]
        public function attributes( array $attributes  ) : array {
            if( $attributes[ 'id' ] === self::SCRIPT . '-js' ) {
                $attributes[ 'id' ] = self::SCRIPT;
                $attributes[ 'type' ] = 'text/javascript';
                $attributes[ 'data-culture' ] = Language::get();
                if( $this->options->getTCF() ) $attributes[ 'data-tcf-v2-enabled' ] = 'true';
                if( $this->options->getGCM() ) $attributes[ 'data-gcm-version' ] = '2.0';
                else $attributes[ 'data-gcm-enabled' ] = 'false';
            }
            return $attributes;
        }

        private static function gcm() : string {
            $script = \apply_filters( Plugin::getPrefix() . 'gcm_code_snippet', \get_option( 'gcm-code-snippet', Plugin::render( 'gcm' ) ) );
            return \trim( \preg_replace( '#<script[^>]*>(.*)</script>#is', '$1', $script ) ); // Backward compatibility
        }
    }
}