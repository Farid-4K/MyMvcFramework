<?php

namespace App\Core;

use App\Core\Factory\JournalFactory;
use Exception;
use RedBeanPHP\R;

abstract class Model extends R
{
    private $journal;

    /**
     * @param string|null $config
     * @param null $user
     * @param null $password
     * @return bool|\RedBeanPHP\ToolBox
     */
    public function connect(string $config, $user = null, $password = null)
    {
        $this->journal = JournalFactory::create(FileSystem::config('journal'));
        try {
            $temp = self::setup($config, $user, $password);
            if (!self::testConnection()) {
                throw new Exception("Could not establish database connection");
            }
            return $temp;
        } catch (Exception $exception) {
            $this->journal->exception($exception);
        }
    }
}
