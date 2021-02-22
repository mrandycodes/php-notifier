<?php

declare(strict_types=1);

namespace App\Context\SharedKernel\Application;

abstract class CommandHandler
{
    abstract public function __invoke(Command $command): void;
}
