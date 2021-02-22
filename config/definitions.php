<?php

use App\Context\Notification\Application\Send\SendNotificationUseCase;
use App\Context\Notification\Domain\Service\NotifierInterface;
use App\Context\Notification\Infrastructure\Service\Notifier\EmailNotifierService;
use App\Context\Notification\UI\Controller\SendNotificationController;
use App\Context\SharedKernel\Infrastructure\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Psr\Container\ContainerInterface;

$definitions = [
    NotifierInterface::class => fn (ContainerInterface $container) =>
    new EmailNotifierService($container->get(PHPMailer::class)),
    SendNotificationUseCase::class => fn (ContainerInterface $container) =>
    new SendNotificationUseCase($container->get(NotifierInterface::class)),
    SendNotificationController::class => fn (ContainerInterface $container) =>
    new SendNotificationController($container->get(SendNotificationUseCase::class)),
    Request::class => new Request(),
    PHPMailer::class => new PHPMailer(true)
];
