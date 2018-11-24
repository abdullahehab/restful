<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagsRepository")
 */
class Tags
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Task", inversedBy="tagsTask")
     * @ORM\JoinColumn(nullable=false)
     */
    private $taskTag;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTaskTag(): ?Task
    {
        return $this->taskTag;
    }

    public function setTaskTag(?Task $taskTag): self
    {
        $this->taskTag = $taskTag;

        return $this;
    }
}
