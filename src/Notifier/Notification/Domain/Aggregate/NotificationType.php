<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Aggregate;

use App\Shared\Domain\ValueObjects\StringValueObject;
use InvalidArgumentException;

final class NotificationType extends StringValueObject
{
    public const TELEGRAM_NOTIFICATION_TYPE = 'telegram';
    public const EMAIL_NOTIFICATION_TYPE = 'email';

    private const ALLOWED_TYPES = [
        self::TELEGRAM_NOTIFICATION_TYPE,
        self::EMAIL_NOTIFICATION_TYPE,
    ];

    private function __construct(string $value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    public static function create(string $value): self
    {
        return new self($value);
    }

    private function validate($value): void
    {
        if (!in_array($value, self::ALLOWED_TYPES)) {
            throw new InvalidArgumentException(
                sprintf('%s is an invalid notification type', $value)
            );
        }
    }
}
