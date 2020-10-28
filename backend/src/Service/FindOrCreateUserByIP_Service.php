<?php

namespace App\Service;

use App\Exception\InvalidUserIP_Exception;
use App\Factory\NewUserFactory;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class FindOrCreateUserByIP_Service
{

    public function __construct(UserRepository $UserRepository, EntityManagerInterface $EntityManager, NewUserFactory $NewUserFactory)
    {
        $this->UserRepository = $UserRepository;
        $this->EntityManager = $EntityManager;
        $this->NewUserFactory = $NewUserFactory;
    }

    public function run($userIP)
    {
        if (empty($userIP))
            throw new InvalidUserIP_Exception();
        $User = $this->UserRepository->findOneByIp($userIP);
        if (empty($User))
            $User = $this->NewUserFactory->make($userIP);
        return $User;
    }
}
