<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\WordPress\Notice;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Registration' ) ) {
    class Registration {
        private array $context;

        public function __construct() {
            $this->context[ 'canonicalDomain' ] = \parse_url( \get_bloginfo( 'url' ), PHP_URL_HOST );
            $this->context[ 'registered' ] = \get_transient( Plugin::getSlug() . '-registered' );
            $this->context[ 'notice' ] = '';

            if( ! isset( $_POST[ 'registration' ] ) ) return;
            if( ! \wp_verify_nonce( $_POST[ 'nonce' ] ?? '', 'registration' ) ) \wp_nonce_ays( 'registration' );

            $data = [
                'canonicalDomain' => $this->context[ 'canonicalDomain' ],
                'accountName' => \sanitize_text_field( $_POST[ 'accountName' ] ?? '' ),
                'email' => \sanitize_email( $_POST[ 'email' ] ?? '' ),
                'password' => \sanitize_text_field( $_POST[ 'password' ] ?? '' ),
                'language' => \strtoupper( Language::get() ),
                'acceptedTermsAndConditions' => isset( $_POST[ 'acceptedTermsAndConditions' ] ),
                'acceptedEmailsAndOffers' => isset( $_POST[ 'acceptedEmailsAndOffers' ] )
            ];

            $result = ( new Account( $data ) )->register();

            \set_transient( Plugin::getSlug() . '-registered', Account::SUCCESS === $result[ 'status' ] );
            $this->context[ 'registered' ] = \get_transient( Plugin::getSlug() . '-registered' );

            $this->context[ 'notice' ] = new Notice( $result[ 'message' ], $result[ 'status' ] );
            $this->context += Account::SUCCESS === $result[ 'status' ] ? $result : $data + $result;
        }

        public function __toString() : string {
            return Plugin::render( 'registration', \array_merge( [
                'plugin' => Plugin::getInstance()
            ], $this->context ) );
        }
    }
}