<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\WordPress\Notice;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Settings' ) ) {
    class Settings {
        private array $context = [];
        private Options $options;

        public function __construct( Options $options ) {
            $this->options = $options;

            $this->context[ 'notice' ] = '';

            if( isset( $_POST[ 'settings' ] ) )
                if( ! \wp_verify_nonce( $_POST[ 'nonce' ] ?? '', 'settings' ) ) \wp_nonce_ays( 'settings' );
                else { $this->options
                    ->setPopup( isset( $_POST[ 'popup' ] ) )
                    ->setTCF( isset( $_POST[ 'tcf' ] ) )
                    ->setGCM( isset( $_POST[ 'gcm' ] ) )
                    ->setVideoAutoblocking( isset( $_POST[ 'videoAutoblocking' ] ) )
                    ->setVideoCategory( $_POST[ 'videoCategory' ] )
                    ->setVideoPlaceholder( $_POST[ 'videoPlaceholder' ] )
                    ->save();
                    $this->context[ 'notice' ] = new Notice( Plugin::__( 'Settings saved.' ), Notice::SUCCESS );
                }

            $this->context += \array_merge( $this->options->dump(), [
                'videoCategories' => Video::CATEGORIES
            ] );
        }

        public function __toString() : string {
            return Plugin::render( 'settings', \array_merge( [
                'plugin' => Plugin::getInstance()
            ], $this->context ) );
        }
    }
}