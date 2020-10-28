<?php

namespace App\Factory;

use App\Entity\User;
use App\Exception\InvalidUserIP_Exception;

class NewUserFactory
{
    public function make($userIP = null)
    {
        if (empty($userIP))
            throw new InvalidUserIP_Exception();
        $User = new User();
        $User->setIP($userIP);
        return $User;
    }
}
