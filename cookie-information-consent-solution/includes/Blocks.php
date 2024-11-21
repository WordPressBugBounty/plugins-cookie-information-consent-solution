<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Blocks' ) ) {
    class Blocks { use Singleton;
        private const DATA = [
            'cookiepolicy' => 'Cookie Information - Cookie policy',
            'privacycontrols' => 'Cookie Information - Privacy controls'
        ];

        protected function __construct() { Plugin::hook( $this ); }

        #[ Action( 'init' ) ]
        public function register() : void {
            foreach( self::DATA as $key => $value )
                \register_block_type( "cookieinformation/$key", [
                    'api_version' => 3,
                    'title' => $value,
                    'category' => 'text',
                    'version' => Plugin::getVersion(),
                    'textdomain' => Plugin::getTextDomain(),
                    'render_callback' => [ Shortcodes::getInstance(), $key ],
                    'editor_script_handles' => [ Plugin::getSlug() . "-$key" ]
                ] );
        }

        #[ Action( 'enqueue_block_editor_assets' ) ]
        public function scripts() : void {
            foreach( \array_keys( self::DATA ) as $key )
                \wp_register_script( Plugin::getSlug() . "-$key", Plugin::getUrl() . "/assets/scripts/$key.js", [
                    'wp-blocks',
                    'wp-element',
                    'wp-editor'
                ], Plugin::getVersion() );
        }
    }
}