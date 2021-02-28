<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Domain\Aggregate;

use App\Notifier\Notification\Domain\Aggregate\NotificationType;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

final class NotificationTypeTest extends TestCase
{
    /** 
     * @dataProvider getTypes 
     * 
     * @param NotificationType $expected
     * @param string $input
     */
    public function test_can_be_created_properly($expected, $input): void
    {
        $notificationType = NotificationType::create($input);

        self::assertTrue($notificationType->equals($expected));
    }

    public function getTypes(): array
    {
        return [
            [
                NotificationType::create(NotificationType::EMAIL_NOTIFICATION_TYPE),
                'email'
            ],
            [
                NotificationType::create(NotificationType::TELEGRAM_NOTIFICATION_TYPE),
                'telegram'
            ]
        ];
    }

    public function test_it_throws_an_exception_when_receive_a_wrong_type(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('wrong-type is an invalid notification type');

        NotificationType::create('wrong-type');
    }
}
