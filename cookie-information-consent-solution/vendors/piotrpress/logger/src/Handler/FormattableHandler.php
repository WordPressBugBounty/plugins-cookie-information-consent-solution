<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Handler;

use CookieInformation\Vendors\PiotrPress\Logger\Formatter\FormatterInterface;
use CookieInformation\Vendors\PiotrPress\Logger\Formatter\DefaultFormatter;

abstract class FormattableHandler {
    protected FormatterInterface $formatter;

    public function __construct( ?FormatterInterface $formatter = null ) {
        $this->formatter = $formatter ?? new DefaultFormatter();
    }
}