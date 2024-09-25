<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;
use CookieInformation\Vendors\PiotrPress\Elementor\Element;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Admin' ) ) {
    class Admin { use Singleton;
        private const PARENT = 'options-general.php';
        private const CAPABILITY = 'manage_options';

        private Options $options;

        public function __construct( Options $options ) {
            $this->options = $options;

            Plugin::hook( $this );
        }

        #[ Filter( 'plugin_action_links' ) ]
        public function link( $actions, $file, $plugin ) : array {
            if( Plugin::getName() === ( $plugin[ 'Name' ] ?? '' ) )
                \array_unshift( $actions, (string) new Element( 'a', [
                    'href' => \admin_url( \add_query_arg( 'page', Plugin::getSlug(), self::PARENT ) )
                ], Plugin::__( 'Settings' ) ) );

            return $actions;
        }

        #[ Action( 'admin_enqueue_scripts' ) ]
        public function styles( $page ) : void {
            \wp_register_style( Plugin::getSlug() . '-menu', Plugin::getUrl() . '/assets/styles/menu.css', [], null );
            \wp_enqueue_style( Plugin::getSlug() . '-menu' );

            if( 'settings_page_' . Plugin::getSlug() !== $page ) return;
            \wp_register_style( Plugin::getSlug() . '-admin', Plugin::getUrl() . '/assets/styles/admin.css', [], null );
            \wp_enqueue_style( Plugin::getSlug() . '-admin' );
        }

        #[ Action( 'admin_enqueue_scripts' ) ]
        public function scrip( $page ) : void {
            if( 'settings_page_' . Plugin::getSlug() !== $page ) return;
            \wp_register_script( Plugin::getSlug() . '-admin', Plugin::getUrl() . '/assets/scripts/admin.js', [ 'jquery', 'postbox' ], null );
            \wp_enqueue_script( Plugin::getSlug() . '-admin' );
        }

        #[ Action( 'admin_menu' ) ]
        public function menu() : void {
            \add_submenu_page(
                self::PARENT,
                Plugin::getName(),
                new Element( 'span', [ 'id' => Plugin::getSlug() . '-icon' ], '' ) . ' ' . Plugin::getName(),
                self::CAPABILITY,
                Plugin::getSlug(),
                [ $this, 'page' ],
                99
            );
        }

        public function page() : void {
            if( ! \current_user_can( self::CAPABILITY ) ) return;

            echo Plugin::render( 'admin', [
                'plugin' => Plugin::getInstance(),
                'registration' => (string) new Registration(),
                'settings' => (string) new Settings( $this->options )
            ] );
        }
    }
}