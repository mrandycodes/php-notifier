<?php

declare(strict_types=1);

namespace App\Context\Notification\Domain\Aggregate;

use App\Context\SharedKernel\Domain\ValueObjects\UuidValueObject;

final class NotificationId extends UuidValueObject
{
    public static function generate(): self
    {
        return new self(parent::generate()->value());
    }
}
