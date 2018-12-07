<?php

namespace App\Core;

use App\Core\Interfaces\ExceptionHandlerInterface;
use Exception;
use SimpleXMLElement;

class ExceptionHandler implements ExceptionHandlerInterface
{
    private $logging = [];

    /**
     * @param int $code
     * @param string $message
     * @return Exception
     */
    public function handler(int $code, string $message): Exception
    {
        return new Exception($code, $message);
    }

    /**
     * @param Exception $exception
     */
    public function logging(Exception $exception)
    {
        $this->logging['message'] = $exception->getMessage();
        $this->logging['file'] = $exception->getFile();
        $this->logging['line'] = $exception->getLine();
        $this->logging['code'] = $exception->getCode();
        $this->logging['time'] = date('d M Y H:i:s');
        $this->writeLog($this->logging);
    }

    private function writeLog(array $data)
    {
        $path = PATH_ROOT . '/app/storage/framework/log';
        $tmp = "\n";
        foreach ($data as $type => $value) {
            $tmp .= $type . ' - ' . $value . "\n";
        }
        $tmp .= "\n*** *** *** ***\n";
        file_put_contents($path, $tmp, FILE_APPEND);
    }
}
