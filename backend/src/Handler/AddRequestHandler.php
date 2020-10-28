<?php

namespace App\Handler;

use App\Converter\WordCollectionToArrayConverter;
use App\Entity\User;
use App\Entity\Word;
use App\Factory\JSON_ResponseFactory;
use App\Factory\NewUserFactory;
use App\Misc\RequestIP_Resolver;
use App\Parser\TextToWordCollectionParser;
use App\Service\AddWordsToExistingUserWordsCountService;
use App\Service\FindOrCreateUserByIP_Service;
use Exception;

class AddRequestHandler
{

    public function __construct($EntityManager)
    {
        /**
         * @todo This one could benefit from Dependency Injection.
         */
        $this->JSON_ResponseFactory = new JSON_ResponseFactory();
        $this->TextToWordCollectionParser = new TextToWordCollectionParser();
        $this->WordCollectionToArrayConverter = new WordCollectionToArrayConverter();
        $this->EntityManager = $EntityManager;
        $this->AddWordsToExistingUserWordsCountService = new AddWordsToExistingUserWordsCountService(
            $this->EntityManager->getRepository(Word::class),
            $this->EntityManager
        );
        $this->FindOrCreateUserByIP_Service = new FindOrCreateUserByIP_Service(
            $this->EntityManager->getRepository(User::class),
            $this->EntityManager,
            new NewUserFactory()
        );
        $this->RequestIP_Resolver = new RequestIP_Resolver();
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
            $User = $this->FindOrCreateUserByIP_Service->run($this->RequestIP_Resolver->get());
            $this->EntityManager->persist($User);
            $this->AddWordsToExistingUserWordsCountService->run($collection, $User);
            $return = [
                "status" => 1,
                "content" => $content,
                "words" => $words
            ];
            $this->EntityManager->flush();
        } catch (Exception $E) {
            $return = [
                "status" => -1,
                "error" => $E->getMessage()
            ];
        }
        return $this->JSON_ResponseFactory->make($return);
    }
}
