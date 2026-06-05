<?php

namespace App\Helpers;

class CodeGenerator
{
    /**
     * Generate secure random Base62 code.
     *
     * Example:
     * A7k9Px
     * zQ82Lm
     */
    public static function generate(int $length = 6): string
    {
        $characters =
            '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $code = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[
                random_int(0, strlen($characters) - 1)
            ];
        }

        return $code;
    }
}