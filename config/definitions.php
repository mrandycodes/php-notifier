<?php

use App\Context\Notification\Application\Send\SendNotificationUseCase;
use App\Context\Notification\Domain\Service\NotifierInterface;
use App\Context\Notification\Infrastructure\PHPMailerClient\PHPMailerClient;
use App\Context\Notification\Infrastructure\Service\Notifier\EmailNotifierService;
use App\Context\Notification\UI\Controller\SendNotificationController;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use Psr\Container\ContainerInterface;

$definitions = [
    NotifierInterface::class => new EmailNotifierService(new PHPMailerClient()),
    SendNotificationUseCase::class => function (ContainerInterface $container) {
        return new SendNotificationUseCase($container->get(NotifierInterface::class));
    },
    SendNotificationController::class => function (ContainerInterface $container) {
        return new SendNotificationController($container->get(SendNotificationUseCase::class));
    },
    Request::class => new Request(),
];
