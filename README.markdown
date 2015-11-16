# PHP/Redis Bloom Filter

PHP Bloom filter with a Redis backend.

```php
<?php

use JuanF\Lib\BloomFilter;

// Init Redis backend (others can be implemented).
$persistence = JuanF\Lib\Persistence\Redis::init();

// Instantiate filter.
$filter = new BloomFilter($persistence);

// Create a new filter, passing a key, bit size, hash count.
$filter->create('filter_key', 10000, 3);

$filter->add("the value");

if ($filter->has('the value')) {
	echo "maybe\n";
}
else {
	echo "not\n";
}
```
