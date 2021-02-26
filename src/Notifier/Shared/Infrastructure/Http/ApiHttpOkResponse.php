<?php

declare(strict_types=1);

namespace App\Notifier\Shared\Infrastructure\Http;

final class ApiHttpOkResponse extends Response
{
    public function __construct()
    {
        parent::__construct([], 200);
    }
}
