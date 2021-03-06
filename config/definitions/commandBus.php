<?php

use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Mapping\ClassName\Suffix;
use League\Tactician\Handler\Mapping\MapByNamingConvention;
use League\Tactician\Handler\Mapping\MethodName\Invoke;
use Psr\Container\ContainerInterface;

$commandBus = [
    CommandBus::class => fn (ContainerInterface $container) =>
    new CommandBus($container->get(CommandHandlerMiddleware::class)),
    CommandHandlerMiddleware::class => fn (ContainerInterface $container) =>
    new CommandHandlerMiddleware($container, $container->get(MapByNamingConvention::class)),
    MapByNamingConvention::class => fn (ContainerInterface $container) =>
    new MapByNamingConvention($container->get(Suffix::class), $container->get(Invoke::class)),
    Suffix::class => new Suffix('Handler'),
    Invoke::class => new Invoke(),
];
