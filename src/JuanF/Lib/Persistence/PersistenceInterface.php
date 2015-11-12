<?php

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{
    static function init($config = null);
    function get($key);
    function set($key, $value);
}
