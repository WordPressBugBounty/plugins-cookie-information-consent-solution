<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Handler;

use CookieInformation\Vendors\PiotrPress\Logger\LogRecord;
use CookieInformation\Vendors\PiotrPress\Logger\Formatter\FormatterInterface;
use CookieInformation\Vendors\PiotrPress\Logger\Formatter\ErrorLogFormatter;

class ErrorLogHandler extends FormattableHandler implements HandlerInterface {
    public function __construct( ?FormatterInterface $formatter = null ) {
        parent::__construct( $formatter ?? new ErrorLogFormatter() );
    }

    public function handle( LogRecord $record ) : bool {
        return @\error_log( $this->formatter->format( $record ) );
    }
}