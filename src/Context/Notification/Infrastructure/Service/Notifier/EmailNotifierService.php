<?php

declare(strict_types=1);

namespace App\Context\Notification\Infrastructure\Service\Notifier;

use App\Context\Notification\Domain\Aggregate\Notification;
use App\Context\Notification\Domain\Service\NotifierInterface;
use App\Context\Notification\Infrastructure\PHPMailerClient\PHPMailerClient;

final class EmailNotifierService implements NotifierInterface
{
    private PHPMailerClient $client;

    public function __construct(PHPMailerClient $client)
    {
        $this->client = $client;
    }

    public function send(Notification $notification): void
    {
        $this->client->init();
    }
}
