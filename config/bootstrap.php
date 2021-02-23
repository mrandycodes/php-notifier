<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/definitions.php';
require dirname(__DIR__) . '/config/routes.php';

use App\Context\SharedKernel\Infrastructure\Routing\Router;
use App\Context\SharedKernel\Infrastructure\DependencyInjection\DependencyInjectionContainer;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$dependencyInjectionContainer = new DependencyInjectionContainer($definitions);
$container = $dependencyInjectionContainer->container();

$router = new Router($routes, $container);
$router->execute();
