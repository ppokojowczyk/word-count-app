<?php

namespace App\Factory;

use Symfony\Component\HttpFoundation\Response;

class TextResponseFactory
{
    public function make($content)
    {
        $Response = new Response();
        $Response->setContent($content);
        return $Response;
    }
}
