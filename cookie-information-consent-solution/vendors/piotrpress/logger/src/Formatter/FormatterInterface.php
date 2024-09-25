<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Formatter;

use CookieInformation\Vendors\PiotrPress\Logger\LogRecord;

interface FormatterInterface {
    public function format( LogRecord $record ) : string;
}