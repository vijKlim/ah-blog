<?php

namespace App\Http;

final readonly class Response
{
    public function __construct(
        private string $content,
        private int    $statusCode = 200
    ) {
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        echo $this->content;
    }
}
