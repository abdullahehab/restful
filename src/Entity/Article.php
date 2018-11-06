<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Negotiation\Exception\InvalidArgument;
use Zend\Code\Exception\InvalidArgumentException;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {

        if (strlen($name)<5){
            throw new InvalidArgumentException('Title needs to have more then 5 characters.');
        }else{
            $this->name = $name;
        }
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}
