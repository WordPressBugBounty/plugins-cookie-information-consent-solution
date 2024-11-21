<?php declare( strict_types = 1 );

defined( 'ABSPATH' ) or exit;

( function() { // Backward compatibility
    if( ( $key = array_search( 'cookie-information-consent-solution/cookie-information.php', $active_plugins = get_option( 'active_plugins', [] ) ) ) !== false )
        update_option( 'active_plugins', array_replace( $active_plugins, [ $key => 'cookie-information-consent-solution/plugin.php' ] ) );
} )();