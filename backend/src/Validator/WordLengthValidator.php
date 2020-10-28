<?php

namespace App\Validator;

class WordLengthValidator
{
    public function validate($word = '')
    {
        return is_string($word) && strlen($word) > 3;
    }
}
