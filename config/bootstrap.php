<?php

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/config/definitions.php';
require dirname(__DIR__) . '/config/routes.php';
require dirname(__DIR__) . '/config/testDefinitions.php';

use App\Shared\Infrastructure\Routing\Router;
use App\Shared\Infrastructure\DependencyInjection\DependencyInjectionContainer;
use Dotenv\Dotenv;

$appEnv = '.env';
$appDefinitions = $definitions;

if (isset($_SERVER['APP_ENV']) && $_SERVER['APP_ENV'] === 'TEST') {
    $appEnv = '.env.test';
    $appDefinitions = $testDefinitions;
}

$dotenv = Dotenv::createImmutable(dirname(__DIR__), $appEnv);
$dotenv->load();

$dependencyInjectionContainer = new DependencyInjectionContainer($appDefinitions);
$container = $dependencyInjectionContainer->container();

$router = new Router($routes, $container);
$router->execute();
