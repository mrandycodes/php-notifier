<?php

declare(strict_types=1);

namespace App\Notifier\Shared\Infrastructure\Http;

final class ApiHttpBadRequestResponse extends Response
{
    public function __construct($data)
    {
        parent::__construct($data, 400);
    }
}
