<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationMessage;

final class NotificationMessageMother
{
    public static function create(string $value): NotificationMessage
    {
        return NotificationMessage::create($value);
    }
}
