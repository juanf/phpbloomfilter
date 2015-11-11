<?php

namespace JuanF\Lib\Persistence;

class Redis extends Persistence
{

    protected static $host = 'localhost';
    protected static $port = 6379;
    protected static $redisInstance;

    public static function init($config)
    {

        self::$host = isset($config['host']) ? $config['host'] : self::$host;
        self::$port = isset($config['port']) ? $config['port'] : self::$port;

        if (!(self::$redisInstance instanceof Redis)) {
            self::$redisInstance = new \Redis();
            self::$redisInstance->connect(self::$host, self::$port);
            self::$redisInstance->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);

            if (isset($config['options']) && count($config['options'])) {
                foreach ($config['options'] as $key => $value) {
                    self::$redisInstance->setOption($key, $value);
                }
            }
        }

        return new self;
    }

    public function get($key)
    {
        echo "get $key\n";
    }

    public function set($key, $value)
    {
        echo "set $key, $value\n";
    }
}
