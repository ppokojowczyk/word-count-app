<?php

namespace App\Factory;

use Symfony\Component\HttpFoundation\Response;

class JSON_ResponseFactory
{
    public function make(array $data = [])
    {
        $Response = new Response();
        $Response->setContent(json_encode($data));
        $Response->headers->set('Content-Type', 'application/json');
        $Response->headers->set('Access-Control-Allow-Origin', '*');
        return $Response;
    }
}
