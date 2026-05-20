<?php

namespace App\Controller;

use App\Http\Response;
use App\View\Renderer;

class HomeController
{
    public function __construct(private readonly Renderer $renderer)
    {
    }

    public function index(): Response
    {
        return new Response(
            $this->renderer->render('home.tpl', [
                'title' => 'Homepage',
            ])
        );
    }
}
