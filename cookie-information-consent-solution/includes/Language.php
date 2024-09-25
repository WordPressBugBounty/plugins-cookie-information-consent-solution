<?php declare( strict_types = 1 );

namespace CookieInformation;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Language' ) ) {
    class Language {
        public static function get() : string {
            switch( true ) {
                case \in_array( self::wpml(), self::support() ) : return self::wpml();
                case \in_array( self::current(), self::support() ) : return self::current();
                default : return 'en';
            }
        }

        // WPML plugin support
        public static function wpml() : ?string {
            return \strtolower( \apply_filters( 'wpml_current_language', '' ) );
        }

        public static function current() : string {
            return \strtolower( \substr( \get_locale(), 0, 2 ) );
        }

        public static function support() : array {
            return include __DIR__ . '/../resources/languages.php';
        }
    }
}