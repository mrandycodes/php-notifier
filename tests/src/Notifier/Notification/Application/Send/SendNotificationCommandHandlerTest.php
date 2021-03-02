<?php

declare(strict_types=1);

namespace Tests\Notifier\Notification\Application\Send;

use App\Notifier\Notification\Application\Send\SendNotificationCommand;
use App\Notifier\Notification\Application\Send\SendNotificationCommandHandler;
use App\Notifier\Notification\Application\Send\SendNotificationUseCase;
use App\Notifier\Notification\Domain\Aggregate\Notification;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tests\Notifier\Notification\Domain\Aggregate\NotificationArgumentsMother;
use Tests\Notifier\Notification\Domain\Aggregate\NotificationMessageMother;
use Tests\Notifier\Notification\Domain\Aggregate\NotificationTypeMother;

final class SendNotificationCommandHandlerTest extends TestCase
{
    private NotifierInterface | MockObject $notifier;
    private SendNotificationCommandHandler $commandHandler;
    private SendNotificationCommand $command;

    public function test_it_can_handle_command(): void
    {
        $this->givenACommand();

        $this->andANotifierThatSendsAnEmailNotification();

        $this->whenHandleCommand();

        $this->thenItShouldNotFail();
    }

    private function givenACommand(): void
    {
        $this->command = new SendNotificationCommand(
            NotificationTypeMother::createWithEmailType()->value(),
            NotificationMessageMother::createDefault()->value(),
            NotificationArgumentsMother::createDefault()->value()
        );
    }

    private function andANotifierThatSendsAnEmailNotification(): void
    {
        $this->notifier
            ->expects(self::once())
            ->method('send')
            ->with(self::callback(
                fn (Notification $notification) => $this->assertNotificationValues($notification)
            ));
    }

    private function assertNotificationValues(Notification $notification): bool
    {
        return $notification->type()->equals(NotificationTypeMother::createWithEmailType())
            && $notification->message()->equals(NotificationMessageMother::createDefault())
            && $notification->arguments()->equals(NotificationArgumentsMother::createDefault());
    }

    private function whenHandleCommand(): void
    {
        $this->commandHandler->__invoke($this->command);
    }

    private function thenItShouldNotFail(): void
    {
        self::assertTrue(true);
    }

    protected function setUp(): void
    {
        $this->notifier = $this->createMock(NotifierInterface::class);

        $this->commandHandler = new SendNotificationCommandHandler(
            new SendNotificationUseCase(
                $this->notifier
            )
        );
    }

    protected function tearDown(): void
    {
        unset($this->command);
    }
}
