<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\EmptyWordsCollectionException;
use App\Exception\InvalidUserIP_Exception;
use App\Repository\WordRepository;
use App\Validator\WordLengthValidator;
use Doctrine\ORM\EntityManagerInterface;

class AddWordsToExistingUserWordsCountService
{

    public function __construct(WordRepository $WordRepository, EntityManagerInterface $EntityManager)
    {
        $this->WordRepository = $WordRepository;
        $this->EntityManager = $EntityManager;
        $this->WordLengthValidator = new WordLengthValidator();
    }

    public function run(array $words = [], User $User)
    {
        if (empty($words))
            throw new EmptyWordsCollectionException();
        if (empty($User->getIp()))
            throw new InvalidUserIP_Exception();
        foreach ($words as $NewWord) {
            if (!$this->WordLengthValidator->validate($NewWord->getWord()))
                continue;
            $Word = $this->WordRepository->findOneByWordAndUserId($NewWord->getWord(), $User->getId());
            if (empty($Word)) {
                $Word = $NewWord;
                $Word->setUser($User);
            } else {
                $Word->setCount($Word->getCount() + $NewWord->getCount());
            }
            $this->EntityManager->persist($Word);
        }
        $this->EntityManager->flush();
    }
}
