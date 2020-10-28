<?php

namespace App\Factory;

use App\Entity\Word;

class WordEntityFromStringFactory
{
    public function make($word = '', $count = 0)
    {
        $Word = new Word();
        $Word->setWord(ucfirst(strtolower($word)));
        $Word->setCount($count);
        return $Word;
    }
}
