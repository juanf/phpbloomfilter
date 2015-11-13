<?php

namespace JuanF\Lib\Hash;

class Crc32b extends Hash
{

    /**
     * {@inheritDoc}
     * @see \JuanF\Lib\Hash\HashInterface::hash()
     */
	public static function hash($txt)
    {
        return sprintf('%u', hexdec(hash('crc32b', $txt)));
    }
}
