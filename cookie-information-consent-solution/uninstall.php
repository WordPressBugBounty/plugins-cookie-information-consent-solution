<?php declare( strict_types = 1 );

defined( 'WP_UNINSTALL_PLUGIN' ) or exit;

if( is_multisite() ) foreach ( get_sites() as $site ) delete_blog_option( $site->blog_id, 'cookie-information' );
else delete_option( 'cookie-information' );