<?php

namespace JuanF\Lib;

use JuanF\Lib\Persistence\Persistence;

class BloomFilter
{

    protected $persistence;
    protected $key;
    protected $size;
    protected $hashCount = 3;
    protected $hashClasses = ['Fnv', 'HashMix', 'Crc32b'];

    public function __construct(Persistence $persistence)
    {

        $this->persistence = $persistence;
    }

    public function create($key, $size, $hashCount)
    {

        $this->key = $key;
        $this->size = $size;
        $this->hashCount = $hashCount;

    }

    public function add($value)
    {
        for ($index = 0; $index < $this->hashCount; $index++) {
            $algo = $this->hashClasses[$index % count($this->hashClasses)];

            $bit = $this->hash($algo, $value, $index);
            $this->persistence->set($this->key, $bit);
        }
    }

    public function has($value)
    {
        $offsets = [];
        for ($index = 0; $index < $this->hashCount; $index++) {
            $algo = $this->hashClasses[$index % count($this->hashClasses)];

            $offsets[] = $this->hash($algo, $value, $index);
        }

        $bits = $this->persistence->get($this->key, $offsets);

        print_r($bits);

        return !in_array(0, $bits);
    }

    protected function hash($algo, $value, $index = 0)
    {
        $class = new \ReflectionClass('JuanF\\Lib\\Hash\\' . $algo);
        $instance = $class->newInstance();
echo "$algo, $value, $index\n";
        return crc32($instance::hash($value . $index)) % $this->size;

    }
}
