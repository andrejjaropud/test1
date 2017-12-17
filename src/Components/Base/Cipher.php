<?php

namespace Components\Base;

/**
 * Class Cipher is used to encrypt password
 *
 * Class Cipher
 * @package Components\Base
 */
class Cipher
{
    /**
     * Function for password encryption
     *
     * @param string  $input  plain password
     * @param integer $rounds cost
     *
     * @return string Encrypt password
     */
    public static function passwordCrypt($input, $rounds = 7)
    {
        $salt = '';
        $salt_chars = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));

        for ($i = 0; $i < 22; $i++) {
            $salt .= $salt_chars[array_rand($salt_chars)];
        }

        return crypt($input, sprintf('$2a$%02d$', $rounds) . $salt);
    }
}