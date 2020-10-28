<?php

namespace App\Parser;

use App\Entity\Word;
use App\Factory\WordEntityFromStringFactory;

class TextToWordCollectionParser
{

    public function __construct()
    {
        $this->WordEntityFromStringFactory = new WordEntityFromStringFactory();
    }

    /**
     * Format and prepare text for parsing.
     * @todo Use regular expressions.
     * @param string $text
     * @return string
     */
    public function formatText($text)
    {
        $text = trim($text, "\n ");
        $text = strtolower($text);
        $text = str_replace("\n", " ", $text);
        return str_replace([";", ".", ",", "-", "_", "?", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "=", "'", '"', '/', "\\"], "", $text);
    }

    public function textToArray($text)
    {
        $words = [];
        foreach (explode(" ", $text) as $word) {
            if (empty($word))
                continue;
            if (!array_key_exists($word, $words)) {
                $words[$word] = 0;
            }
            $words[$word]++;
        }
        return $words;
    }

    public function makeEntityForWord($word, $count)
    {
        return $this->WordEntityFromStringFactory->make($word, $count);
    }

    public function parse($text)
    {
        $collection = [];

        $text = $this->formatText($text);
        $words = $this->textToArray($text);
        foreach ($words as $word => $count) {
            $collection[] = $this->makeEntityForWord($word, $count);
        }

        return $collection;
    }
}
