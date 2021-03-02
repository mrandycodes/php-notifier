<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\Notification;

final class NotificationMother
{
    public static function createEmailNotification(): Notification
    {
        return Notification::create(
            NotificationIdMother::create(),
            NotificationTypeMother::createWithEmailType(),
            NotificationMessageMother::createDefault(),
            NotificationArgumentsMother::createDefault()
        );
    }
}
