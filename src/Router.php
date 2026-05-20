<?php

namespace App;

use App\Controller\ArticleController;
use App\Controller\CategoryController;
use App\Controller\HomeController;
use App\Http\Request;
use App\Http\Response;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

final class Router
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function dispatch(Request $request, ContainerInterface $container): Response
    {
        $path = parse_url($request->uri, PHP_URL_PATH);

        return match ($path) {
            '/' => $container->get(HomeController::class)->index($request),
            '/category' => $container->get(CategoryController::class)->show($request),
            '/article' => $container->get(ArticleController::class)->show($request),
            default => new Response('Page not found', 404),
        };
    }
}