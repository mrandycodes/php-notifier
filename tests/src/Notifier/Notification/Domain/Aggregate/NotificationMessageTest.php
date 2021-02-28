<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationMessage;
use PHPUnit\Framework\TestCase;

final class NotificationMessageTest extends TestCase
{
    public function test_can_be_created_properly(): void
    {
        $value = 'some message';
        $notificationMessage = NotificationMessage::create($value);

        self::assertSame($value, $notificationMessage->value());
    }
}
