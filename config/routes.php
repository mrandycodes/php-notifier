<?php

use App\Context\SharedKernel\Infrastructure\Routing\Router;

$routes = [
    'health' => [
        Router::METHOD_KEY => 'GET',
        Router::PATH_KEY => '/_health',
        Router::CONTROLLER_CLASS_NAME_KEY => 'App\Context\Notification\UI\Controller\HealthController'
    ],
    'notify' => [
        Router::METHOD_KEY => 'POST',
        Router::PATH_KEY => '/notify',
        Router::CONTROLLER_CLASS_NAME_KEY => 'App\Context\Notification\UI\Controller\SendNotificationController'
    ],
];
