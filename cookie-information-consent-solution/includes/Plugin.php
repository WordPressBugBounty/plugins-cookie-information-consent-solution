<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\Psr\Log\LoggerInterface;
use CookieInformation\Vendors\PiotrPress\TemplaterInterface;
use CookieInformation\Vendors\PiotrPress\CacherInterface;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Plugin' ) ) {
    class Plugin extends \CookieInformation\Vendors\PiotrPress\WordPress\Plugin {
        private LoggerInterface $logger;
        private TemplaterInterface $templater;
        private CacherInterface $cacher;

        protected function __construct( string $file, LoggerInterface $logger, TemplaterInterface $templater, CacherInterface $cacher ) {
            parent::__construct( $file );

            $this->logger = $logger;
            $this->templater = $templater;
            $this->cacher = $cacher;

            $options = new Options( self::getSlug() );

            Popup::getInstance( $options );
            Video::getInstance( $options );
            Admin::getInstance( $options );
            Shortcodes::getInstance();
            Blocks::getInstance();
        }

        static public function log( $level, string $message, array $context = [] ) : void {
            self::getInstance()->logger->log( $level, "[{name}] $message", $context + [ 'name' => self::getName() ] );
        }

        static public function render( string $template, array $context = [] ) : string {
            return self::getInstance()->templater->render( $template, $context );
        }

        static public function hook( object $object = null, string $callback = '' ) : void {
            Hooks::add( $object, $callback, self::getInstance()->cacher );
        }

        static public function __( string $text ) : string {
            return \__( $text, self::getTextDomain() );
        }

        public function activation() : void {}
        public function deactivation() : void {}
    }
}