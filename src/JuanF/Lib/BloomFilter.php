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

    }

    public function create($key, $size, $hashCount)
    {

    	$this->key = $key;
    	$this->size = $size;
    	$this->hashCount = $hashCount;

    }

}
