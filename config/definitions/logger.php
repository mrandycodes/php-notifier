<?php

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

$logger = [
    LoggerInterface::class => function () {
        $log = new Logger('default');
        $stream = new StreamHandler(__DIR__ . '/../../var/log/app.log', Logger::WARNING);
        $stream->setFormatter(new JsonFormatter());
        $log->pushHandler($stream);

        return $log;
    },
];
