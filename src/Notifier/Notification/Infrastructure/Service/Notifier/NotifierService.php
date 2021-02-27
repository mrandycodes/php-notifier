<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Infrastructure\Service\Notifier;

use App\Notifier\Notification\Domain\Aggregate\Notification;
use App\Notifier\Notification\Domain\Service\NotifierInterface;

final class NotifierService implements NotifierInterface
{
    private NotifierFactory $notifierFactory;

    public function __construct(NotifierFactory $notifierFactory)
    {
        $this->notifierFactory = $notifierFactory;
    }

    public function send(Notification $notification): void
    {
        $notifierService = $this->notifierFactory->createFrom($notification->type());

        if ($notifierService) {
            $notifierService->send($notification);
        }
    }
}
