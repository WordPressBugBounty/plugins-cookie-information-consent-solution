<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress\Logger\Formatter;

use CookieInformation\Vendors\PiotrPress\Logger\LogRecord;
use CookieInformation\Vendors\PiotrPress\Templater\Template;

class TemplateFormatter extends DefaultFormatter {
    protected string $template;

    public function __construct( string $template ) {
        $this->template = $template;
    }

    public function format( LogRecord $record ) : string {
        return (string)( new Template( $this->template, \array_merge( $record->getContext(), [
            'message' => parent::format( $record ),
            'level' => $record->getLevel()
        ] ) ) );
    }
}