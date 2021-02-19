<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Application\Service\Http\Routing;

use App\Context\SharedKernel\Application\Service\Http\Request;
use InvalidArgumentException;

final class Router
{
    private const METHOD_KEY = 'method';
    private const PATH_KEY = 'path';
    private const CONTROLLER_CLASS_NAME_KEY = 'controller';

    private array $routes;

    public function __construct()
    {
        $this->routes = [];
    }

    public function add(string $method, string $path, string $controller): void
    {
        $this->routes[] = [
            self::METHOD_KEY => $method,
            self::PATH_KEY => $path,
            self::CONTROLLER_CLASS_NAME_KEY =>  $controller
        ];
    }

    public function call(): void
    {
        $routesFiltered = array_values(
            array_filter(
                $this->routes,
                static fn (array $route): bool =>
                (bool) preg_match(sprintf("/^\%s/", $route[self::PATH_KEY]), $_SERVER['REQUEST_URI'])
                    && $_SERVER['REQUEST_METHOD'] === $route[self::METHOD_KEY]
            )
        );

        if (empty($routesFiltered)) {
            throw new InvalidArgumentException(
                sprintf('No route found for "%s %s"', $_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI'])
            );
        }

        $controllerClassName = $routesFiltered[0][self::CONTROLLER_CLASS_NAME_KEY];
        $class = new $controllerClassName();

        echo (call_user_func_array([$class, '__invoke'], [new Request()]))->result();
    }
}
