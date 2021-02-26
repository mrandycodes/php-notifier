<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Shared\Domain\ValueObjects\UuidValueObject;

final class NotificationId extends UuidValueObject
{
    public static function generate(): self
    {
        return new self(parent::generate()->value());
    }
}
