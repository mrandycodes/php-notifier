<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationArguments;

final class NotificationArgumentsMother
{
    public static function create(array $arguments): NotificationArguments
    {
        return NotificationArguments::create($arguments);
    }
}
