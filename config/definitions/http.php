<?php

use App\Shared\Infrastructure\Http\Request;

$http = [
    Request::class => new Request(file_get_contents('php://input')),
];
