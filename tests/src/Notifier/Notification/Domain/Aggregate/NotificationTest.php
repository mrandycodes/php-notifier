<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\Notification;
use PHPUnit\Framework\TestCase;

final class NotificationTest extends TestCase
{
    public function test_can_be_created_properly(): void
    {
        $id = NotificationIdMother::create();
        $message = NotificationMessageMother::create('some message');
        $arguments = NotificationArgumentsMother::create(['param' => 'some value']);
        $type = NotificationTypeMother::createWithEmailType();

        $notification = Notification::create(
            $id,
            $type,
            $message,
            $arguments
        );

        self::assertTrue($notification->id()->equals($id));
        self::assertTrue($notification->type()->equals($type));
        self::assertTrue($notification->message()->equals($message));
        self::assertSame($arguments->value(), $notification->arguments()->value());
    }
}
