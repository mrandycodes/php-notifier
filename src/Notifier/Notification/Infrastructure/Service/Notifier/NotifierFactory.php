<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Infrastructure\Service\Notifier;

use App\Notifier\Notification\Domain\Aggregate\NotificationType;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use InvalidArgumentException;

final class NotifierFactory
{
    private array $notifierServices;

    public function __construct(
        NotifierInterface $mailNotifierService
    ) {
        $this->notifierServices = [
            NotificationType::EMAIL_NOTIFICATION_TYPE => $mailNotifierService,
        ];
    }

    public function createFrom(NotificationType $type): NotifierInterface
    {
        $notifierService =  $this->notifierServices[$type->value()] ?? null;

        if (!$notifierService) {
            throw new InvalidArgumentException(
                sprintf('There is no notifier for notification type <%s>', $type)
            );
        }

        return $notifierService;
    }
}
