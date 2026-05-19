<?php

namespace App;

use App\Http\Request;
use App\Http\Response;

final class Application
{
    public function run(): Response
    {
        $request = Request::createFromGlobals();
        $router = new Router();
        return $router->dispatch($request);
    }
}
