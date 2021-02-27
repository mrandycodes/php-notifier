<?php

use App\Notifier\Notification\Application\Send\SendNotificationCommandHandler;
use App\Notifier\Notification\Application\Send\SendNotificationUseCase;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierFactory;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierService;
use App\Notifier\Notification\Infrastructure\Service\Notifier\PHPMailerNotifierService;
use Apps\Notifier\Backend\UI\Controller\SendNotificationController;
use App\Shared\Infrastructure\Http\Request;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\Mapping\ClassName\Suffix;
use League\Tactician\Handler\Mapping\MapByNamingConvention;
use League\Tactician\Handler\Mapping\MethodName\Invoke;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

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

$notifier = [
    PHPMailer::class => new PHPMailer(true),
];

$http = [
    Request::class => new Request(),
];

$loggin = [
    LoggerInterface::class => function () {
        $log = new Logger('default');
        $stream = new StreamHandler(dirname(__DIR__) . '/var/log/app.log', Logger::WARNING);
        $stream->setFormatter(new JsonFormatter());
        $log->pushHandler($stream);

        return $log;
    },
];

$sendNotification = [
    NotifierInterface::class => function (ContainerInterface $container) {
        return new NotifierService($container->get(NotifierFactory::class));
    },
    NotifierFactory::class => fn (ContainerInterface $container) => new NotifierFactory($container),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(CommandBus::class)),
    SendNotificationCommandHandler::class => fn (ContainerInterface $container) =>
    new SendNotificationCommandHandler($container->get(SendNotificationUseCase::class)),
    PHPMailerNotifierService::class => fn (ContainerInterface $container) =>
    new PHPMailerNotifierService($container->get(PHPMailer::class), $container->get(LoggerInterface::class)),
];

$definitions = array_merge(
    $commandBus,
    $notifier,
    $http,
    $sendNotification,
    $loggin,
);
