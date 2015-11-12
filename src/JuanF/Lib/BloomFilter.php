<?php

namespace JuanF\Lib;

use JuanF\Lib\Persistence\Persistence;

class BloomFilter
{

    protected $persistence;
    protected $key;
    protected $size;
    protected $hashCount = 3;

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

    		echo $this->hash($value, $index), "\n";
//	        $this->persistence->set($this->key, $value);
    	}

    }

    protected function hash($value, $index = 0)
    {

        return crc32($value . $index) % $this->size;
    }
}
