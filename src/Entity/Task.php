<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tags", mappedBy="taskTag", orphanRemoval=true)
     */
    private $tagsTask;

    public function __construct()
    {
        $this->tagsTask = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }


    /**
     * @return Collection|Tags[]
     */
    public function getTagsTask(): Collection
    {
        return $this->tagsTask;
    }

    public function addTagsTask(Tags $tagsTask): self
    {
        if (!$this->tagsTask->contains($tagsTask)) {
            $this->tagsTask[] = $tagsTask;
            $tagsTask->setTaskTag($this);
        }

        return $this;
    }

    public function removeTagsTask(Tags $tagsTask): self
    {
        if ($this->tagsTask->contains($tagsTask)) {
            $this->tagsTask->removeElement($tagsTask);
            // set the owning side to null (unless already changed)
            if ($tagsTask->getTaskTag() === $this) {
                $tagsTask->setTaskTag(null);
            }
        }

        return $this;
    }
}
