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

namespace JuanF\Lib;

use JuanF\Lib\Persistence\Persistence;

class BloomFilter
{

    protected $persistence;
    protected $key;
    protected $size;
    protected $hashCount = 3;
    protected $hashClasses = ['Fnv', 'HashMix', 'Crc32b'];

    /**
     * Constructor
     *
     * @param Persistence $persistence
     */
    public function __construct(Persistence $persistence)
    {
        $this->persistence = $persistence;
    }

    /**
     * Create filter.
     *
     * @param string $key
     * @param int $size
     * @param int $hashCount
     */
    public function create($key, $size, $hashCount)
    {
        $this->key = $key;
        $this->size = $size;
        $this->hashCount = $hashCount;
    }

    /**
     * Add new value to the filter.
     *
     * @param string $value
     */
    public function add($value)
    {
        for ($index = 0; $index < $this->hashCount; $index++) {
            $algo = $this->hashClasses[$index % count($this->hashClasses)];

            $bit = $this->hash($algo, $value, $index);
            $this->persistence->set($this->key, $bit);
        }
    }

    /**
     * Check if the value exists on the filter.
     *
     * @param string $value
     * @return boolean False if it doesn't exist, true if it probably exists.
     */
    public function has($value)
    {
        $offsets = [];
        for ($index = 0; $index < $this->hashCount; $index++) {
            $algo = $this->hashClasses[$index % count($this->hashClasses)];

            $offsets[] = $this->hash($algo, $value, $index);
        }

        $bits = $this->persistence->get($this->key, $offsets);

        return !in_array(0, $bits);
    }

    /**
     * Create a hash from the given string.
     *
     * @param string $algo
     * @param string $value
     * @param int $index
     */
    protected function hash($algo, $value, $index = 0)
    {
        $class = new \ReflectionClass('JuanF\\Lib\\Hash\\' . $algo);
        $instance = $class->newInstance();

        return crc32($instance::hash($value . $index)) % $this->size;
    }
}
