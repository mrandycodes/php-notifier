<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http;

final class Request
{
    private $content;

    public function __construct()
    {
        $this->content = file_get_contents('php://input');
    }

    /** 
     * @return mixed
     */
    public function content()
    {
        return $this->content;
    }
}