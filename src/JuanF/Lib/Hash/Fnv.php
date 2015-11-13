<?php

namespace JuanF\Lib\Hash;

class Fnv extends Hash
{

    /**
     * {@inheritDoc}
     * @see \JuanF\Lib\Hash\HashInterface::hash()
     */
    public static function hash($txt)
    {
        return sprintf('%u', hexdec(hash('fnv1a32', $txt)));
    }
}
