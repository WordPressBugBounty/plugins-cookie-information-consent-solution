<?php declare( strict_types = 1 );

namespace CookieInformation;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Options' ) ) {
    class Options {
        private string $name;
        private array $data;

        public function __construct( string $name ) {
            if( $this->data = \get_option( $this->name = $name, [] ) ) return;

            $this // Backward compatibility
                ->setPopup( (bool)\get_option( 'enable-popup', false ) )
                ->setTCF( (bool)\get_option( 'enable-tcf', false ) )
                ->setGCM( (bool)\get_option( 'enable-gcm', false ) )
                ->setVideoAutoblocking( (bool)\get_option( 'enable-video-sdk', false ) )
                ->setVideoCategory( (string)\get_option( 'video-sdk-category', 'cookie_cat_marketing' ) )
                ->setVideoPlaceholder( (string)\get_option( 'placeholder-text', '' ) )
                ->save();
        }

        public function dump() : array {
            return $this->data;
        }

        public function getPopup() : bool {
            return $this->data[ 'popup' ];
        }

        public function getTCF() : bool {
            return $this->data[ 'tcf' ];
        }

        public function getGCM() : bool {
            return $this->data[ 'gcm' ];
        }

        public function getVideoAutoblocking() : bool {
            return $this->data[ 'videoAutoblocking' ];
        }

        public function getVideoCategory() : string {
            return $this->data[ 'videoCategory' ];
        }

        public function getVideoPlaceholder() : string {
            return $this->data[ 'videoPlaceholder' ];
        }

        public function setPopup( bool $value ) : self {
            $this->data[ 'popup' ] = $value;
            return $this;
        }

        public function setTCF( bool $value ) : self {
            $this->data[ 'tcf' ] = $value;
            return $this;
        }

        public function setGCM( bool $value ) : self {
            $this->data[ 'gcm' ] = $value;
            return $this;
        }

        public function setVideoAutoblocking( bool $value ) : self {
            $this->data[ 'videoAutoblocking' ] = $value;
            return $this;
        }

        public function setVideoCategory( string $value ) : self {
            $this->data[ 'videoCategory' ] = \in_array( $value, \array_keys( Video::CATEGORIES ) ) ? $value : 'cookie_cat_marketing';
            return $this;
        }

        public function setVideoPlaceholder( string $value = '' ) : self {
            $value = \trim( $value ) ?: 'You have to consent to statistic cookies to see this content.<br><span>Click here to renew consent</span>';
            $this->data[ 'videoPlaceholder' ] = $value;
            return $this;
        }

        public function save() : bool {
            return \update_option( $this->name, $this->data );
        }
    }
}