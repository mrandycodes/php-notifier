<?php

use App\Notifier\Notification\Application\Send\SendNotificationCommandHandler;
use App\Notifier\Notification\Application\Send\SendNotificationUseCase;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierFactory;
use App\Notifier\Notification\Infrastructure\Service\Notifier\NotifierService;
use Apps\Notifier\Backend\UI\Controller\SendNotificationController;
use League\Tactician\CommandBus;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Tests\Notifier\Notification\Infrastructure\Notifier\FakeMailerClient;
use Tests\Notifier\Notification\Infrastructure\Notifier\FakeMailerNotifierService;

$notification = [
    NotifierInterface::class => function (ContainerInterface $container) {
        return new NotifierService($container->get(NotifierFactory::class));
    },
    NotifierFactory::class => fn (ContainerInterface $container) =>
    new NotifierFactory($container->get(FakeMailerNotifierService::class)),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(CommandBus::class)),
    SendNotificationCommandHandler::class => fn (ContainerInterface $container) =>
    new SendNotificationCommandHandler($container->get(SendNotificationUseCase::class)),
    FakeMailerNotifierService::class => fn (ContainerInterface $container) =>
    new FakeMailerNotifierService($container->get(FakeMailerClient::class), $container->get(LoggerInterface::class)),
    FakeMailerClient::class => new FakeMailerClient(),
];
