<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationId;

final class NotificationIdMother
{
    public static function create(): NotificationId
    {
        return NotificationId::generate();
    }
}
