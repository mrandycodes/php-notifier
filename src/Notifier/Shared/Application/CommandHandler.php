<?php

declare(strict_types=1);

namespace App\Notifier\Shared\Application;

abstract class CommandHandler
{
    abstract public function __invoke(Command $command): void;
}
