<?php

/**
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * Copyright 2015 Juan Ferrari
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JuanF\Lib\Persistence;

class Redis extends Persistence
{

    protected static $host = 'localhost';
    protected static $port = 6379;
    protected static $redisInstance;

    /**
     * Init Redis backend. Optionally pass a Redis instance or an array
     * with host, port and options.
     *
     * @param array $parmas
     */
    public static function init($params)
    {
        if ($params instanceof \Redis) {
            self::$redisInstance = $params;
        } elseif (is_array($params)) {
            self::$host = isset($params['host']) ? $params['host'] : self::$host;
            self::$port = isset($params['port']) ? $params['port'] : self::$port;
        }

        if (!(self::$redisInstance instanceof \Redis)) {
            self::$redisInstance = new \Redis();
            self::$redisInstance->connect(self::$host, self::$port);
            self::$redisInstance->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);

            if (isset($params['options']) && count($params['options'])) {
                foreach ($params['options'] as $key => $value) {
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
