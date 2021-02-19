<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Domain\Controller;

abstract class Response
{
    abstract protected function result(): string;
}
