<?php

use App\Context\SharedKernel\Application\Service\Http\Routing\Router;

require dirname(__DIR__) . '/vendor/autoload.php';

$router = new Router();

$router->add('GET', '/_health', 'App\Context\Notification\UI\Controller\HealthController');
$router->add('POST', '/notify', 'App\Context\Notification\UI\Controller\SendNotificationController');

try {
    $router->call();
} catch (Exception $ex) {
    http_response_code(404);
    echo $ex->getMessage();
}
