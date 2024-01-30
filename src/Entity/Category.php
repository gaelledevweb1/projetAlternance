<?php

namespace App\Entity;

use App\Repository\CategoryRepository;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameCategory = null;

    

    #[ORM\Column(length: 255)]
    private ?string $CategoryImages = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategory(): ?string
    {
        return $this->nameCategory;
    }

    public function setNameCategory(string $nameCategory): static
    {
        $this->nameCategory = $nameCategory;

        return $this;
    }

    public function getCategoryImages(): ?string
    {
        return $this->CategoryImages;
    }

    public function setCategoryImages(string $CategoryImages): static
    {
        $this->CategoryImages = $CategoryImages;

        return $this;
    }
    
}

// category-Images en plus