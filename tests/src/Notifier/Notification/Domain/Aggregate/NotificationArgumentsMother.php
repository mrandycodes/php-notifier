<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationArguments;

final class NotificationArgumentsMother
{
    private const DEFAULT_ARGUMENTS = ['foo' => 'bar'];

    public static function create(array $arguments): NotificationArguments
    {
        return NotificationArguments::create($arguments);
    }

    public static function createDefault(): NotificationArguments
    {
        return self::create(self::DEFAULT_ARGUMENTS);
    }
}
