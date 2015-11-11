<?php

namespace JuanF\Lib\Persistence;

class Redis extends Persistence
{

    protected $host = 'localhost';
    protected $port = 6379;
    private $redisInstance;

    public static function init($config)
    {

        $this->host = isset($config['host']) ? $config['host'] : $this->host;
        $this->port = isset($config['port']) ? $config['port'] : $this->port;

        if (!($this->redisInstance instanceof Redis)) {
            $this->redisInstance = new Redis();
            $this->redisInstance->connect($this->host, $this->port);
            $this->redisInstance->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);

            if (isset($config['options']) && count($config['options'])) {
                foreach ($config['options'] as $key => $value) {
                    $this->redisInstance->setOption($key, $value);
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
