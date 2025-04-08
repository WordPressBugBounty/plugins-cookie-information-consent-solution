<?php declare( strict_types = 1 );

/**
 * Plugin Name: Cookie Information
 * Plugin URI: https://cookieinformation.com/extension/wordpress/
 * Description: Easily set up Google Consent Mode and custom cookie banners to comply with GDPR, ePrivacy, CCPA. Collect consent and build trust with your customers.
 * Version: 2.1.1
 * Requires at least: 6.0
 * Requires PHP: 7.4
 * Author: Cookie Information A/S
 * Author URI: https://cookieinformation.com/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cookie-information
 * Domain Path: /languages
 */

namespace CookieInformation;

use CookieInformation\Vendors\PiotrPress\Cacher;
use CookieInformation\Vendors\PiotrPress\Logger;
use CookieInformation\Vendors\PiotrPress\Logger\Handler\ErrorLogHandler;
use CookieInformation\Vendors\PiotrPress\Templater;

\defined( 'ABSPATH' ) or exit;

require __DIR__ . '/autoload.php';

try {
    Plugin::getInstance(
        __FILE__,
        new Logger( new ErrorLogHandler() ),
        new Templater( __DIR__ . '/templates' ),
        new Cacher( __DIR__ . '/.cache', 'development' === \wp_get_environment_type() ? 0 : -1 )
    );
} catch( \Exception $exception ) {
    \error_log( '[Cookie Information] ' . $exception->getMessage() );
    \error_log( $exception->getTraceAsString() );
}