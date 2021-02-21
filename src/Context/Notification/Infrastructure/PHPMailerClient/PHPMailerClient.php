<?php

declare(strict_types=1);

namespace App\Context\Notification\Infrastructure\PHPMailerClient;

use Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

final class PHPMailerClient
{
    private PHPMailer $client;

    public function __construct()
    {
        $this->client = new PHPMailer(true);
    }

    public function init(): void
    {
        //ToDo: use DotEnv or DI to asign varibles from .env
        try {
            $this->client->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->client->isSMTP();
            $this->client->Host = 'smtp.example.com';
            $this->client->SMTPAuth = true;
            $this->client->Username = 'user@example.com';
            $this->client->Password = 'secret';
            $this->client->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->client->Port = 587;
            $this->client->setFrom('from@example.com', 'Mailer');
        } catch (Exception $exception) {
            throw $exception;
        }
    }
}
