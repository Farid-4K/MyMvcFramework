<?php

namespace App\Core\Interfaces;

interface ExceptionHandlerInterface
{
    public function handler(int $code, string $message);
}
