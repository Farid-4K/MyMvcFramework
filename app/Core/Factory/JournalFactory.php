<?php

namespace App\Core\Factory;

use App\Core\Journal;

/**
 * Class JournalFactory
 *
 * @package App\Core\Factory
 */
class JournalFactory
{
    /**
     * Create instance
     *
     * @param array $config
     * @return Journal
     */
    public static function create(array $config)
    {
        return new Journal($config);
    }
}
