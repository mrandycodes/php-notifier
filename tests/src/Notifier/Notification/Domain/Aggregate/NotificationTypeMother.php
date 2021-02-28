<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationType;

final class NotificationTypeMother
{
    public static function createWithEmailType(): NotificationType
    {
        return NotificationType::create(NotificationType::EMAIL_NOTIFICATION_TYPE);
    }

    public static function createWithTelegramType(): NotificationType
    {
        return NotificationType::create(NotificationType::TELEGRAM_NOTIFICATION_TYPE);
    }
}
