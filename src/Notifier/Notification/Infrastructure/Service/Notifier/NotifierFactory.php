<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Infrastructure\Service\Notifier;

use App\Notifier\Notification\Domain\Aggregate\NotificationType;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use App\Notifier\Notification\Infrastructure\Service\Notifier\PHPMailerNotifierService;
use Psr\Container\ContainerInterface;

final class NotifierFactory
{
    private array $notifierServices;

    public function __construct(
        PHPMailerNotifierService $mailNotifierService
    ) {
        $this->notifierServices = [
            NotificationType::EMAIL_NOTIFICATION_TYPE => $mailNotifierService,
        ];
    }

    public function createFrom(NotificationType $type): ?NotifierInterface
    {
        $notifierService =  $this->notifierServices[$type->value()];

        if (empty($notifierService)) {
            return null;
        }

        return $notifierService;
    }
}
