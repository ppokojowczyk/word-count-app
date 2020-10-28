<?php

namespace App\Handler;

use App\Converter\WordCollectionToArrayConverter;
use App\Factory\JSON_ResponseFactory;
use App\Parser\TextToWordCollectionParser;
use Exception;

class CountRequestHandler
{

    public function __construct()
    {
        /**
         * @todo This one could benefit from Dependency Injection.
         */
        $this->JSON_ResponseFactory = new JSON_ResponseFactory();
        $this->TextToWordCollectionParser = new TextToWordCollectionParser();
        $this->WordCollectionToArrayConverter = new WordCollectionToArrayConverter();
    }

    /**
     * Handle request.
     * @param Request $Request
     * @return Response
     */
    public function handle($Request)
    {
        $return = [];
        try {
            $data = json_decode($Request->getContent(), true);
            $content = $data['content'];
            $collection = $this->TextToWordCollectionParser->parse($content);
            $words = $this->WordCollectionToArrayConverter->convert($collection);
            $return = [
                "status" => 1,
                "content" => $content,
                "words" => $words
            ];
        } catch (Exception $E) {
            $return = [
                "status" => -1,
                "error" => $E->getMessage()
            ];
        }
        return $this->JSON_ResponseFactory->make($return);
    }
}
