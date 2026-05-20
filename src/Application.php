<?php

namespace App;

use App\Http\Request;
use App\Http\Response;
use App\View\Renderer;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Dotenv\Dotenv;
use Exception;
use Psr\Container\ContainerExceptionInterface;

final class Application
{
    /**
     * @throws DependencyException
     * @throws NotFoundException
     * @throws Exception
     * @throws ContainerExceptionInterface
     */
    public function run(): Response
    {
        Dotenv::createImmutable(__DIR__)->safeLoad();

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(dirname(__DIR__) . '/config/container.php');
        $container = $containerBuilder->build();

        $request = Request::createFromGlobals();
        $router = $container->get(Router::class);

        return $router->dispatch($request, $container);
    }
}
