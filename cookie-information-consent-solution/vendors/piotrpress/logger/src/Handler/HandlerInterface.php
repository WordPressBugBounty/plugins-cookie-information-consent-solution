<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Handler;

use CookieInformation\Vendors\PiotrPress\Logger\LogRecord;

interface HandlerInterface {
    public function handle( LogRecord $record ) : bool;
}