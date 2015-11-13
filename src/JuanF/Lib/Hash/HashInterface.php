<?php

namespace JuanF\Lib\Hash;

interface HashInterface
{
	/**
	 * Generate a hash for the given string.
	 *
	 * @param string $txt
	 * @return int
	 */
    static function hash($value);
}
