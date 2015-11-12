<?php

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{
    protected static function init($config = null);
    protected function get($key);
    protected function set($key, $value);
}
