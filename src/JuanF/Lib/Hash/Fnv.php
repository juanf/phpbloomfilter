<?php

namespace JuanF\Lib\Hash;

class Fnv extends Hash
{

    const FNV_offset_basis_32 = 2166136261;

    /**
     * Based on https://code.google.com/p/boyanov/source/browse/fnvhash/fnvhash-inc.php?repo=prototypes
     * {@inheritDoc}
     * @see \JuanF\Lib\Hash\HashInterface::hash()
     */
/*    public static function hash($txt)
    {
        $buf = str_split($txt);
        $hash = self::FNV_offset_basis_32;

        foreach ($buf as $chr) {
            $hash += ($hash << 1) + ($hash << 4) + ($hash << 7) + ($hash << 8) + ($hash << 24);
            $hash = $hash ^ ord($chr);
        }

        $hash = $hash & 0x0ffffffff;

        return $hash;
    }*/

    public static function hash($txt)
    {
        return sprintf('%u', hexdec(hash('fnv1a32', $txt)));
    }
}
