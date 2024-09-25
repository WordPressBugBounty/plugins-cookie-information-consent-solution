<?php declare( strict_types = 1 );

namespace CookieInformation\Vendors\PiotrPress;

interface CacherInterface {
    public function get( string $key, callable $callback, ...$args );
    public function clear( string $key = null ) : bool;
    public function expired() : bool;
}