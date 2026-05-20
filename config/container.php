<?php

use App\Database\Connection;
use App\View\Renderer;

return [
    PDO::class => static fn() => Connection::create(),

    Renderer::class => static fn() => new Renderer(
        dirname(__DIR__) .  '/templates',
        dirname(__DIR__)  . '/var/cache/smarty'
    ),
];