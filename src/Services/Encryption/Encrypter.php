<?php

namespace Inoplate\Foundation\Services\Encryption;

use Inoplate\Foundation\App\Services\Encryption\Encrypter as Contract;

class Encrypter implements Contract
{
    /**
     * Encrypt value
     * 
     * @param  string $value
     * @return string
     */
    public function encrypt($value)
    {
        return bcrypt($value);
    }
}