<?php

namespace JuanF\Lib;

use JuanF\Lib\Persistence\Persistence;

class BloomFilter
{

    protected $persistence;
    protected $key;
    protected $size;
    protected $hashCount = 3;
    protected $hashClasses = ['Fnv', 'HashMix'];

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

        	$this->hash($algo, $value, $index);



//	        $this->persistence->set($this->key, $value);
        }

    }

    protected function hash($algo, $value, $index = 0)
    {
    	$class = new \ReflectionClass('JuanF\\Lib\\Hash\\' . $algo);
    	$instance = $class->newInstance();

    	echo "$algo hash: ", $instance::hash($value . $index), "\n";

        return crc32($value . $index) % $this->size;
    }
}
