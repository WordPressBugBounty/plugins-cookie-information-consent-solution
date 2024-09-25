<?php declare( strict_types = 1 );

namespace CookieInformation;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Account' ) ) {
    class Account {
        private const ENDPOINT = 'https://partner-integration-api.app.cookieinformation.com/api/v2/register';
        public const SUCCESS = 'success';
        public const ERROR = 'error';

        private array $data = [
            'accountName' => '',
            'email' => '',
            'password' => '',
            'language' => 'EN',
            'acceptedTermsAndConditions' => false,
            'acceptedEmailsAndOffers' => false,
            'phone' => ''
        ];

        public function __construct( array $data ) {
            $this->data = \wp_parse_args( $data, $this->data );
        }

        protected function request() {
            return \wp_remote_post( self::ENDPOINT, [
                'method' => 'POST',
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
                'body' => \wp_json_encode( $this->data )
            ] );
        }

        public function register() : array {
            if( \is_wp_error( $response = $this->request() ) ) {
                $result[ 'message' ] = Plugin::__( 'We encountered an unexpected server issue. Try again in a few minutes.' );
                Plugin::log( self::ERROR, 'Registration failed with message: ' . $response->get_error_message() );
            } else switch( $code = \wp_remote_retrieve_response_code( $response ) ) {
                case 201 :
                    $result[ 'status' ] = self::SUCCESS;
                    $result[ 'message' ] = Plugin::__( "You're all set! Your account has been created in Cookie Information. Check your email for further instructions." );
                    break;
                case 400 :
                    $result[ 'errors' ] = [];
                    $body = \json_decode( \wp_remote_retrieve_body( $response ), true );

                    foreach( $body[ 'errors' ] ?? [] as $error )
                        if( \is_null( $error[ 'field' ] ) ) {
                            $result[ 'message' ] = $error[ 'message' ];
                        } else {
                            $result[ 'errors' ][ $error[ 'field' ] ][] = $error[ 'message' ];
                            $result[ 'message' ] = Plugin::__( 'Something went wrong with your registration. See possible errors below and try again.' );
                        }

                    break;
                default :
                    $result[ 'message' ] = Plugin::__( 'We encountered an unexpected server issue. Try again in a few minutes.' );
                    Plugin::log( self::ERROR, 'Registration failed with code: ' . $code );
            }

            return \array_merge( [ 'status' => self::ERROR, 'message' => '', 'errors' => [] ], $result );
        }
    }
}