<?php

namespace Tests\Notifier\Notification\Infrastructure\Notifier;

use App\Notifier\Notification\Domain\Aggregate\Notification;
use App\Notifier\Notification\Domain\Service\NotifierInterface;
use Exception;
use Psr\Log\LoggerInterface;

final class FakeMailerNotifierService implements NotifierInterface
{
    private const ARGUMENT_TO = 'to';
    private const ARGUMENT_ALIAS = 'alias';
    private const ARGUMENT_SUBJECT = 'subject';

    private FakeMailerClient $client;
    private LoggerInterface $logger;

    public function __construct(FakeMailerClient $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
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
            $this->client->addAddress($arguments[self::ARGUMENT_TO], $arguments[self::ARGUMENT_ALIAS]);

            //Content
            $this->client->isHTML(true);
            $this->client->Subject = $arguments[self::ARGUMENT_SUBJECT];
            $this->client->Body = $notification->message()->value();

            $this->client->send();
        } catch (Exception $exception) {
            $this->logger->error(
                '<FakeMailer> There was an error when service try to send a notification email',
                $exception->getTrace()
            );
        }
    }
}
