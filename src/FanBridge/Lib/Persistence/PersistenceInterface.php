<?php

namespace FanBridge\Lib\Persistence;

interface PersistenceInterface {
	protected static function init($config);
	protected function get($key);
	protected function set($key, $value);
}
