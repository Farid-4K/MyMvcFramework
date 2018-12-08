<?php

namespace App\Core\Interfaces;

use Exception;

/**
 * Interface JournalInterface
 * @package App\Core\Interfaces
 */
interface JournalInterface
{
    /**
     * Write $message to file
     *
     * @param string $message
     */
    public function write(string $message): void;

    /**
     * Write $exception info to file
     *
     * @param Exception $exception
     * @return mixed
     */
    public function exception(Exception $exception);
}
