<?php declare( strict_types = 1 );

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Singleton;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Action;
use CookieInformation\Vendors\PiotrPress\WordPress\Hooks\Filter;
use CookieInformation\Vendors\PiotrPress\Elementor\Element;
use CookieInformation\Vendors\PiotrPress\Elementor\Attributes;

\defined( 'ABSPATH' ) or exit;

if( ! \class_exists( __NAMESPACE__ . '\Video' ) ) {
    class Video { use Singleton;
        public const CATEGORIES = [
            'cookie_cat_marketing' => 'Marketing',
            'cookie_cat_functional' => 'Functional',
            'cookie_cat_statistic' => 'Statistical'
        ];

        private Options $options;

        protected function __construct( Options $options ) {
            $this->options = $options;

            Plugin::hook( $this );
        }

        #[ Filter( 'the_content' ) ]
        public function filter( $content ) : string {
            if( $this->options->getVideoAutoblocking() )
                foreach( [
                    '/<iframe[^>]*src=\"[^\"]*youtu[.]?be.*<\/iframe>/mi',
                    '/<iframe[^>]*src=\"[^\"]*vimeo.*<\/iframe>/mi'
                ] as $regex ) {
                    \preg_match_all( $regex, $content, $matches );
                    foreach( $matches as $video ) {
                        $src = (string) new Attributes( [
                            'data-category-consent' => $this->options->getVideoCategory(),
                            'src' => 'about:blank',
                            'data-consent-src'
                        ] );
                        $replace = \str_replace( 'src', $src, $video );
                        $content = \str_replace( $video, $replace, $content );
                    }
                }
            return $content;
        }

        #[ Action( 'wp_footer' ) ]
        public function placeholder() : void {
            if( $this->options->getVideoAutoblocking() )
                echo new Element( 'script', [ 'type' => 'text/javascript' ], Plugin::render( 'video', [
                    'category' => $this->options->getVideoCategory(),
                    'placeholder' => $this->options->getVideoPlaceholder(),
                    'class' => \apply_filters(
                        Plugin::getPrefix() . 'video_placeholder_class',
                        \get_option( 'placeholder-class', 'placeholder-consent-text' ) // Backward compatibility
                    )
                ] ) );
        }
    }
}