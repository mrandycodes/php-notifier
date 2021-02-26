<?php

use App\Notifier\Notification\Application\Send\SendNotificationCommandHandler;
use App\Notifier\Notification\Application\Send\SendNotificationUseCase;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use App\Notifier\Notification\Infrastructure\Service\Notifier\PHPMailerNotifierService;
use Apps\Notifier\Backend\UI\Controller\SendNotificationController;
use App\Notifier\Shared\Infrastructure\Http\Request;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Mapping\ClassName\Suffix;
use League\Tactician\Handler\Mapping\MapByNamingConvention;
use League\Tactician\Handler\Mapping\MethodName\Invoke;
use PHPMailer\PHPMailer\PHPMailer;
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

$mailer = [
    PHPMailer::class => new PHPMailer(true),
];

$http = [
    Request::class => new Request(),
];

$sendNotification = [
    NotifierInterface::class => fn (ContainerInterface $container) =>
    new PHPMailerNotifierService($container->get(PHPMailer::class)),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(CommandBus::class)),
    SendNotificationCommandHandler::class => fn (ContainerInterface $container) =>
    new SendNotificationCommandHandler($container->get(SendNotificationUseCase::class)),
];

$definitions = array_merge(
    $commandBus,
    $mailer,
    $http,
    $sendNotification,
);
