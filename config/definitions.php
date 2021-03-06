<?php

require dirname(__DIR__) . '/config/definitions/commandBus.php';
require dirname(__DIR__) . '/config/definitions/http.php';
require dirname(__DIR__) . '/config/definitions/notification.php';
require dirname(__DIR__) . '/config/definitions/logger.php';

$definitions = array_merge(
    $commandBus,
    $http,
    $notification,
    $logger,
);
