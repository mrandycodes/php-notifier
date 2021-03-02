<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationMessage;

final class NotificationMessageMother
{
    private const DEFAULT_MESSAGE = 'Purus Vehicula Ullamcorper';

    public static function create(string $value): NotificationMessage
    {
        return NotificationMessage::create($value);
    }

    public static function createDefault(): NotificationMessage
    {
        return self::create(self::DEFAULT_MESSAGE);
    }
}
