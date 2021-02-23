<?php

use App\Context\Notification\Application\Send\SendNotificationCommandHandler;
use App\Context\Notification\Application\Send\SendNotificationUseCase;
use App\Context\Notification\Domain\Service\NotifierInterface;
use App\Context\Notification\Infrastructure\Service\Notifier\EmailNotifierService;
use App\Context\Notification\UI\Controller\SendNotificationController;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Mapping\ClassName\Suffix;
use League\Tactician\Handler\Mapping\MapByNamingConvention;
use League\Tactician\Handler\Mapping\MethodName\Invoke;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Container\ContainerInterface;

$definitions = [
    NotifierInterface::class => fn (ContainerInterface $container) =>
    new EmailNotifierService($container->get(PHPMailer::class)),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(CommandBus::class)),
    Request::class => new Request(),
    PHPMailer::class => new PHPMailer(true),
    CommandBus::class => fn (ContainerInterface $container) =>
    new CommandBus($container->get(CommandHandlerMiddleware::class)),
    CommandHandlerMiddleware::class => fn (ContainerInterface $container) =>
    new CommandHandlerMiddleware($container, $container->get(MapByNamingConvention::class)),
    MapByNamingConvention::class => fn (ContainerInterface $container) =>
    new MapByNamingConvention($container->get(Suffix::class), $container->get(Invoke::class)),
    Suffix::class => new Suffix('Handler'),
    Invoke::class => new Invoke(),
    SendNotificationCommandHandler::class => fn (ContainerInterface $container) =>
    new SendNotificationCommandHandler($container->get(SendNotificationUseCase::class)),
];
