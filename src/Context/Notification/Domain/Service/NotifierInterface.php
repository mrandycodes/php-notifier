<?php

declare(strict_types=1);

namespace App\Context\Notification\Domain\Service;

use App\Context\Notification\Domain\Aggregate\Notification;

interface NotifierInterface
{
    public function send(Notification $notification): void;
}
