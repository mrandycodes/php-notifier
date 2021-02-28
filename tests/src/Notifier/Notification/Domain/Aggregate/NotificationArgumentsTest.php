<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationArguments;
use PHPUnit\Framework\TestCase;

final class NotificationArgumentsTest extends TestCase
{
    public function test_can_be_created_properly(): void
    {
        $arguments = ['param' => 'value'];

        $notificationArguments = NotificationArguments::create($arguments);

        self::assertSame($arguments, $notificationArguments->value());
    }
}
