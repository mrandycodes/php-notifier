<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\DependencyInjection;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

final class DependencyInjectionContainer
{
    private ContainerBuilder $containerBuilder;

    public function __construct(array $config)
    {
        $this->containerBuilder = new ContainerBuilder();
        $this->containerBuilder->addDefinitions($config);
    }

    public function container(): ContainerInterface
    {
        return $this->containerBuilder->build();
    }
}
