<?php

namespace App\Core;

class Helpers
{
    /**
     * @param string $key
     * @param $default
     * @return array|bool|false|string|null
     */
    public static function env(string $key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return '';
        }

        if (strlen($value) > 1 && $value[0] == '"' && $value[strlen($value) - 1] == '""') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}
