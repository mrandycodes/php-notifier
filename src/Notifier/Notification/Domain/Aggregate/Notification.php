<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Aggregate;

final class Notification
{
    private NotificationId $id;
    private NotificationType $type;
    private NotificationMessage $message;
    private NotificationArguments $arguments;

    private function __construct(
        NotificationId $id,
        NotificationType $type,
        NotificationMessage $message,
        NotificationArguments $arguments
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->message = $message;
        $this->arguments = $arguments;
    }

    public static function create(
        NotificationId $id,
        NotificationType $type,
        NotificationMessage $message,
        NotificationArguments $arguments
    ): self {
        return new self($id, $type, $message, $arguments);
    }

    public function id(): NotificationId
    {
        return $this->id;
    }

    public function type(): NotificationType
    {
        return $this->type;
    }

    public function message(): NotificationMessage
    {
        return $this->message;
    }

    public function arguments(): NotificationArguments
    {
        return $this->arguments;
    }
}
