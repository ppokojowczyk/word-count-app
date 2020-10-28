<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="word")
 * @ORM\Entity(repositoryClass="App\Repository\WordRepository")
 */
class Word
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $userId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="User")
     */
    protected $User;

    /**
     * @ORM\Column(type="text")
     */
    protected $word;

    /**
     * @ORM\Column(type="integer")
     */
    protected $count;

    protected $stars = 0;

    public function setWord($word)
    {
        $this->word = $word;
    }

    public function getWord()
    {
        return $this->word;
    }

    public function setCount($count)
    {
        $this->count = $count;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUser(User $User)
    {
        $this->User = $User;
    }

    public function setStars($stars)
    {
        $this->stars = $stars;
    }

    public function getStars()
    {
        return $this->stars;
    }
}
