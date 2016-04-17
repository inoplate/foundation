<?php

namespace Inoplate\Foundation\App\Services\Encryption;

interface Encrypter
{
    /**
     * Encrypt value
     * 
     * @param  string $value
     * @return string
     */
    public function encrypt($value);
}