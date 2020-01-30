<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Representation", inversedBy="categories")
     */
    private $representation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Artist", mappedBy="category")
     */
    private $artist;

    public function __construct()
    {
        $this->artist = new ArrayCollection();
    }

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

    public function getRepresentation(): ?Representation
    {
        return $this->representation;
    }

    public function setRepresentation(?Representation $representation): self
    {
        $this->representation = $representation;

        return $this;
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtist(): Collection
    {
        return $this->artist;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artist->contains($artist)) {
            $this->artist[] = $artist;
            $artist->setCategory($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artist->contains($artist)) {
            $this->artist->removeElement($artist);
            // set the owning side to null (unless already changed)
            if ($artist->getCategory() === $this) {
                $artist->setCategory(null);
            }
        }

        return $this;
    }
}
