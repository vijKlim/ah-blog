<?php

namespace App\Http;

final readonly class Request
{
    public function __construct(
        public string $uri,
        public string $method,
        public array  $query = [],
    ) {
    }

    public static function createFromGlobals(): self
    {
        return new self(
            $_SERVER['REQUEST_URI'],
            $_SERVER['REQUEST_METHOD'],
            $_GET,
        );
    }
}
