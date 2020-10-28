<?php

namespace App\Handler;

use App\Converter\WordCollectionToArrayConverter;
use App\Factory\JSON_ResponseFactory;
use App\Processor\WordsCollectionProcessor;
use Exception;

class WordsRequestHandler
{

    public function __construct($WordsRepository)
    {
        $this->JSON_ResponseFactory = new JSON_ResponseFactory();
        $this->WordsRepository = $WordsRepository;
        $this->WordCollectionToArrayConverter = new WordCollectionToArrayConverter();
        $this->WordsCollectionProcessor = new WordsCollectionProcessor();
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
            $userIP = (new \App\Misc\RequestIP_Resolver())->get();
            $wordsCollection = $this->WordsRepository->fetchByUserIP($userIP);
            $this->WordsCollectionProcessor->process($wordsCollection);
            $return = [
                "status" => 1,
                "words" => $this->WordCollectionToArrayConverter->convert($wordsCollection)
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
