<?php

namespace App\Controller;

use App\Entity\Word;
use App\Factory\JSON_ResponseFactory;
use App\Factory\TextResponseFactory;
use App\Handler\AddRequestHandler;
use App\Handler\CountRequestHandler;
use App\Handler\WordsRequestHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WordCountController extends AbstractController
{

    /**
     * Response text for default route.
     * @var string
     */
    const HELLO_TEXT = "word-count-app-backend";

    public function __construct()
    {
        $this->JSON_ResponseFactory = new JSON_ResponseFactory();
        $this->TextResponseFactory = new TextResponseFactory();
    }

    /**
     * Handle default "/" route request.
     * @return Response
     */
    public function hello()
    {
        return $this->TextResponseFactory->make(static::HELLO_TEXT);
    }

    /**
     * Handle count request.
     * @param Request $Request
     * @return Response
     */
    public function count(Request $Request)
    {
        return (new CountRequestHandler())->handle($Request);
    }

    public function words(Request $Request)
    {
        return (new WordsRequestHandler(
            $this->getDoctrine()->getRepository(Word::class)
        ))->handle($Request);
    }

    public function add(Request $Request)
    {
        return (new AddRequestHandler($this->getDoctrine()->getManager()))->handle($Request);
    }
}
