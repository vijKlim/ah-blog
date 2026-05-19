<?php

namespace App;

use App\Controller\HomeController;
use App\Http\Request;
use App\Http\Response;

final class Router
{
    public function dispatch(Request $request): Response
    {
        $path = parse_url($request->uri, PHP_URL_PATH);

        return match ($path) {
            '/' => (new HomeController())->index(),
            default => new Response('Page not found', 404),
        };
    }
}