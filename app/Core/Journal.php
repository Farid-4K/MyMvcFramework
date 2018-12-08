<?php

namespace App\Core;

use App\Core\Interfaces\JournalInterface;
use Exception;

/**
 * Class Journal
 * @package App\Core
 */
final class Journal implements JournalInterface
{
    private $path;

    private $prefix;

    /**
     * @param string $message
     */
    public function write(string $message): void
    {
        $filename = $this->path . '/journal-' . substr(round(START_TIME), 0, 6);
        file_put_contents($filename, $message, FILE_APPEND);
    }

    /**
     * Journal constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->prefix = hash('md5', START_TIME);
        $this->path = PATH_ROOT . $config['path'];
        $this->write("\n" . date('d M y H:i:s '));
    }

    public function __destruct()
    {
        $this->write(" * ");
    }

    /**
     * @param Exception $exception
     * @return mixed|void
     */
    public function exception(Exception $exception)
    {
        $this->write($exception->getMessage());
    }
}
