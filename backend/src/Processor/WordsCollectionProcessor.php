<?php

namespace App\Processor;

class WordsCollectionProcessor
{
    public function process($words)
    {
        $stars = 3;
        foreach ($words as $Word) {
            $Word->setStars($stars);
            $stars--;
            if ($stars == 0)
                break;
        }
        return $words;
    }
}
