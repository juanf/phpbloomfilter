<?php

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{
    static function init($config = null);
    function get($key, $value);
    function set($key, $value);
}
