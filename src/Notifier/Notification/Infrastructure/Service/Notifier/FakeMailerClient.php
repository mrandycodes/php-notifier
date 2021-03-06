<?php

namespace App\Notifier\Notification\Infrastructure\Service\Notifier;

final class FakeMailerClient
{
    public int $SMTPDebug = 0;
    public string $Host = 'localhost';
    public bool $SMTPAuth = false;
    public string $Username = '';
    public string $Password = '';
    public string $SMTPSecure = '';
    public int $Port = 25;

    private string $From = '';
    private string $FromName = '';

    private array $RecipientsQueue = [];

    private string $ContentType = '';

    public string $Subject = '';
    public string $Body = '';
    private string $Mailer = '';

    public function isSMTP(): bool
    {
        $this->Mailer = 'smtp';

        return true;
    }

    public function setFrom(string $address, string $name): bool
    {
        $this->From = $address;
        $this->FromName = $name;

        return true;
    }

    public function addAddress(string $address, string $name): bool
    {
        $this->RecipientsQueue[$address] = [$address, $name];

        return true;
    }

    public function isHTML(): bool
    {
        $this->ContentType = 'text/html';

        return true;
    }

    public function send(): bool
    {
        return true;
    }
}
