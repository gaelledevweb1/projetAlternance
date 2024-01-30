<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $articleQuantity = null;

     #[ORM\OneToOne( cascade: ['persist', 'remove'])]
    
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Article::class)]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    // #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Article::class, orphanRemoval: true)]
    // private Collection $article;

    // public function __construct()
    // {
    //     $this->article = new ArrayCollection();
    // }

    // #[ORM\OneToMany(mappedBy: 'cart', targetEntity: Article::class, orphanRemoval: true)]
    // private Collection $article;

    // public function __construct()
    // {
    //     $this->article = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticleQuantity(): ?int
    {
        return $this->articleQuantity;
    }

    public function setArticleQuantity(int $articleQuantity): static
    {
        $this->articleQuantity = $articleQuantity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    
    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCart($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getCart() === $this) {
                $article->setCart(null);
            }
        }

        return $this;
    }
}

