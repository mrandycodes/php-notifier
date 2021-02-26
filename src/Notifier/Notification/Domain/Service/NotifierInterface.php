<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Domain\Service;

use App\Notifier\Notification\Domain\Aggregate\Notification;

interface NotifierInterface
{
    public function send(Notification $notification): void;
}
