<?php

namespace App\Context\SharedKernel\Domain\Controller;

final class ApiHttpOkResponse extends Response
{
    private array $data;
    private int $code;

    private function __construct(array $data, int $code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    public static function create(): self
    {
        return new self([], 200);
    }

    public function result(): string
    {
        http_response_code($this->code);

        return json_encode($this->data, 15);
    }
}
