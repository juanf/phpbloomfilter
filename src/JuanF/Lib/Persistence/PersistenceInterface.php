<?php

namespace JuanF\Lib\Persistence;

interface PersistenceInterface
{

    /**
     * Init backend
     * @param array $config Optional
     */
    static function init($config = null);

    /**
     * Get the given bits for the key.
     *
     * @param string $key
     * @param array $bits
     * @return array
     */
    function get($key, $value);

    /**
     * Set the given bit of the current key to 1.
     *
     * {@inheritDoc}
     * @see \JuanF\Lib\Persistence\PersistenceInterface::set()
     *
     * @param string $key
     * @param int $bit
     * @return
     */
    function set($key, $value);
}
