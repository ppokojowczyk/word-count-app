<?php

namespace App\Repository;

use App\Exception\InvalidUserIP_Exception;
use Doctrine\ORM\EntityRepository;

class WordRepository extends EntityRepository
{

    const QUERY_LIMIT = 100000;

    public function fetchByUserIP($userIP = '')
    {
        if (empty($userIP))
            throw new InvalidUserIP_Exception();
        return $this->createQueryBuilder("w")
            ->leftJoin("w.User", "u")
            ->where("u.ip = :ip")->setParameter("ip", $userIP)
            ->orderBy("w.count", "DESC")
            ->addOrderBy('w.word', 'ASC')
            ->setMaxResults(static::QUERY_LIMIT)
            ->getQuery()->execute();
    }

    public function findOneByWordAndUserId($word, $userId)
    {
        return $this->findOneBy([
            "word" => $word,
            "userId" => $userId
        ]);
    }
}
