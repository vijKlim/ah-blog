<?php

namespace App\Controller;

use App\Http\Response;

class HomeController
{
    public function index(): Response
    {
        return new Response('<h1>Welcome!</h1>');
    }
}
