<?php

declare(strict_types=1);

namespace App\Context\Notification\Application\Send;

use App\Context\Notification\Domain\Aggregate\Notification;
use App\Context\Notification\Domain\Aggregate\NotificationArguments;
use App\Context\Notification\Domain\Aggregate\NotificationId;
use App\Context\Notification\Domain\Aggregate\NotificationMessage;
use App\Context\Notification\Domain\Aggregate\NotificationType;
use App\Context\Notification\Domain\Service\NotifierInterface;

final class SendNotificationUseCase
{
    private NotifierInterface $notifierInterface;

    public function __construct(NotifierInterface $notifierInterface)
    {
        $this->notifierInterface = $notifierInterface;
    }

    public function __invoke(NotificationParamHolder $notificationParamHolder): void
    {
        $notification = $this->buildNotification($notificationParamHolder);

        $this->notifierInterface->send($notification);
    }

    private function buildNotification($notificationParamHolder): Notification
    {
        return Notification::create(
            NotificationId::generate(),
            NotificationType::create($notificationParamHolder->type()),
            NotificationMessage::create($notificationParamHolder->message()),
            NotificationArguments::create($notificationParamHolder->arguments())
        );
    }
}
