<?php

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{

    private function __construct();

    protected static function init($config);
    protected function get($key);
    protected function set($key, $value);
}
