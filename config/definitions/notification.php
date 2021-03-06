<?php

use App\Notifier\Notification\Application\Send\SendNotificationCommandHandler;
use App\Notifier\Notification\Application\Send\SendNotificationUseCase;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierFactory;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierService;
use App\Notifier\Notification\Infrastructure\Service\Notifier\PHPMailerNotifierService;
use Apps\Notifier\Backend\UI\Controller\SendNotificationController;
use League\Tactician\CommandBus;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

$notification = [
    NotifierInterface::class => function (ContainerInterface $container) {
        return new NotifierService($container->get(NotifierFactory::class));
    },
    NotifierFactory::class => fn (ContainerInterface $container) =>
    new NotifierFactory($container->get(PHPMailerNotifierService::class)),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(CommandBus::class)),
    SendNotificationCommandHandler::class => fn (ContainerInterface $container) =>
    new SendNotificationCommandHandler($container->get(SendNotificationUseCase::class)),
    PHPMailerNotifierService::class => fn (ContainerInterface $container) =>
    new PHPMailerNotifierService($container->get(PHPMailer::class), $container->get(LoggerInterface::class)),
    PHPMailer::class => new PHPMailer(true),
];
