<?php

namespace JuanF\Lib\Hash;

class Crc32b extends Hash
{

    public static function hash($txt)
    {
        return sprintf('%u', hexdec(hash('crc32b', $txt)));
    }
}
