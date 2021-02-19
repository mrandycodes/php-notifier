<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Application\Service\Http;

abstract class Response
{
    abstract protected function result(): string;
}
