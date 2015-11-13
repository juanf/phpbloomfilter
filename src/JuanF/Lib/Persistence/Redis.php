<?php

namespace JuanF\Lib\Persistence;

class Redis extends Persistence
{

    protected static $host = 'localhost';
    protected static $port = 6379;
    protected static $redisInstance;

    /**
     * Init Redis backend. Optionally pass host, port and options.
     *
     * @param array $config
     */
    public static function init($config = [])
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

    /**
     * {@inheritDoc}
     * @see \JuanF\Lib\Persistence\PersistenceInterface::get()
     */
    public function get($key, $bits)
    {
        $pipe = self::$redisInstance->pipeline();

        foreach ($bits as $bit) {
            $pipe->getBit($key, $bit);
        }

        return $pipe->exec();
    }

    /**
     * {@inheritDoc}
     * @see \JuanF\Lib\Persistence\PersistenceInterface::set()
     */
    public function set($key, $bit)
    {
        $pipe = self::$redisInstance->pipeline();

        $pipe->setBit($key, $bit, 1);
        return $pipe->exec();
    }
}
