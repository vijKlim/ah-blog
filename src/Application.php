<?php

namespace App;

use App\Http\Request;
use App\Http\Response;
use App\View\Renderer;

final class Application
{
    public function run(): Response
    {
        $request = Request::createFromGlobals();

        $router = new Router();
        [$controllerClass, $method] =  $router->dispatch($request);

        $renderer = new Renderer(
            __DIR__ . '/../templates',
            __DIR__ . '/../var/cache/smarty',
        );

        $controller = new $controllerClass($renderer);

        return $controller->{$method}($request);
    }
}
