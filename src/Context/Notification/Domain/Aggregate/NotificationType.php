<?php

declare(strict_types=1);

namespace App\Context\Notification\Domain\Aggregate;

use App\Context\SharedKernel\Domain\ValueObjects\StringValueObject;
use InvalidArgumentException;

final class NotificationType extends StringValueObject
{
    private const TELEGRAM_NOTIFICATION_TYPE = 'telegram';

    private const ALLOWED_TYPES = [
        self::TELEGRAM_NOTIFICATION_TYPE,
    ];

    private function __construct(string $value)
    {
        $this->guard($value);

        parent::__construct($value);
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    protected function guard($value): void
    {
        if (!in_array($value, self::ALLOWED_TYPES)) {
            throw new InvalidArgumentException(
                sprintf('%s is an invalid notification type', $value)
            );
        }
    }
}
