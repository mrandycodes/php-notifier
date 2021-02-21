<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Infrastructure\Routing;

use App\Context\SharedKernel\Domain\Controller\ApiHttpBadRequestResponse;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use InvalidArgumentException;
use Psr\Container\ContainerInterface;

final class Router
{
    public const METHOD_KEY = 'method';
    public const PATH_KEY = 'path';
    public const CONTROLLER_CLASS_NAME_KEY = 'controller';

    private array $routes;
    private ContainerInterface $containerInterface;

    public function __construct(
        array $routes,
        ContainerInterface $containerInterface
    ) {
        $this->routes = $routes;
        $this->containerInterface = $containerInterface;
    }

    public function execute(): void
    {
        try {
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

            $controller = $this->containerInterface->get($routesFiltered[0][self::CONTROLLER_CLASS_NAME_KEY]);
            $request = $this->containerInterface->get(Request::class);

            echo $controller->__invoke($request)->result();
        } catch (InvalidArgumentException $ex) {
            echo (new ApiHttpBadRequestResponse($ex->getMessage()))->result();
        }
    }
}
