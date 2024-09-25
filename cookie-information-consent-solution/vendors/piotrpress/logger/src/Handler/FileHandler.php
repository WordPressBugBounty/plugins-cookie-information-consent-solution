<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Handler;

use CookieInformation\Vendors\PiotrPress\Logger\LogRecord;
use CookieInformation\Vendors\PiotrPress\Logger\Formatter\FormatterInterface;
use CookieInformation\Vendors\PiotrPress\Logger\Formatter\FileFormatter;

class FileHandler extends FormattableHandler implements HandlerInterface {
    private string $file;

    public function __construct( string $file, ?FormatterInterface $formatter = null  ) {
        parent::__construct( $formatter ?? new FileFormatter() );
        $this->file = $file;
    }

    public function handle( LogRecord $record ) : bool {
        return (bool)@\file_put_contents( $this->file, $this->formatter->format( $record ), FILE_APPEND );
    }
}