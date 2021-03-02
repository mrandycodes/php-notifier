<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationId;

final class NotificationIdMother
{
    private const DEFAULT_ID = '9e9f0496-35bd-4afe-b897-5ba26149c319';

    public static function create(): NotificationId
    {
        return NotificationId::generate();
    }

    public static function createDefault(): NotificationId
    {
        return new NotificationId(self::DEFAULT_ID);
    }
}
