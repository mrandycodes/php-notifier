<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http;

abstract class Response
{
    private $data;
    private int $code;

    public function __construct($data, int $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public function result(): string
    {
        http_response_code($this->code);
        return json_encode($this->data, 15);
    }
}
