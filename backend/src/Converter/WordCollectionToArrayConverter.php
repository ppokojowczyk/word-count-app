<?php

namespace App\Converter;

class WordCollectionToArrayConverter implements CollectionToArrayConverterInterface
{
    public function convert($collection)
    {
        $data = [];
        foreach ($collection as $Entity) {
            $data[] = [
                "id" => $Entity->getId(),
                "word" => $Entity->getWord(),
                "count" => $Entity->getCount(),
                "userId" => $Entity->getUserId(),
                "stars" => $Entity->getStars()
            ];
        }
        return $data;
    }
}
