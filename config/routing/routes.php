<?php

use App\Context\SharedKernel\Infrastructure\Routing\Router;

$router = new Router();

$router->add('GET', '/_health', 'App\Context\Notification\UI\Controller\HealthController');
$router->add('POST', '/notify', 'App\Context\Notification\UI\Controller\SendNotificationController');

$router->execute();
