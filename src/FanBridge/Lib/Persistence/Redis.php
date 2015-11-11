<?php

namespace FanBridge\Lib\Persistence;

class Redis extends Persistence {

	public static function init($config)
	{
	
		return new self;
	}

	public function get($key)
	{

	}

	public function set($key, $value)
	{

	}
}
