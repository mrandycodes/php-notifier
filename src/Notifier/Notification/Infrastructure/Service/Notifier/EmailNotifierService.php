<?php

declare(strict_types=1);

namespace App\Notifier\Notification\Infrastructure\Service\Notifier;

use App\Notifier\Notification\Domain\Aggregate\Notification;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

final class EmailNotifierService implements NotifierInterface
{
    private PHPMailer $client;

    public function __construct(PHPMailer $client)
    {
        $this->client = $client;
    }

    public function send(Notification $notification): void
    {
        try {
            //Server settings
            $this->client->SMTPDebug = $_ENV['MAILER_CLIENT_DEBUG_LEVEL'];
            $this->client->isSMTP();
            $this->client->Host = $_ENV['MAILER_CLIENT_HOST'];
            $this->client->SMTPAuth = $_ENV['MAILER_SMTP_AUTH'];
            $this->client->Username = $_ENV['MAILER_USERNAME'];
            $this->client->Password = $_ENV['MAILER_USER_PASSWORD'];
            $this->client->SMTPSecure = $_ENV['MAILER_SMTP_SECURE'];
            $this->client->Port = $_ENV['MAILER_CLIENT_PORT'];

            //Recipients
            $arguments = $notification->arguments()->value();
            $this->client->setFrom($_ENV['MAILER_USERNAME'], 'INFO');
            $this->client->addAddress($arguments['to'], $arguments['alias']);

            //Content
            $this->client->isHTML(true);
            $this->client->Subject = $arguments['subject'];
            $this->client->Body    = $notification->message()->value();

            $this->client->send();
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
