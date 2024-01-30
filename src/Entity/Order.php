<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column]
    private ?bool $paid = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column]
    private ?bool $delivered = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $deliveryDate = null;

    #[ORM\Column(length: 255)]
    private ?string $deliveryInfo = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    
    private ?Address $address = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    
    private ?User $user = null;

    #[ORM\OneToOne( cascade: ['persist', 'remove'])]
    
    private ?Cart $cart = null;

    // #[ORM\OneToOne(mappedBy: 'order1', cascade: ['persist', 'remove'])]
    // private ?Paiement $paiement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function isPaid(): ?bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): static
    {
        $this->paid = $paid;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function isDelivered(): ?bool
    {
        return $this->delivered;
    }

    public function setDelivered(bool $delivered): static
    {
        $this->delivered = $delivered;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): static
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDeliveryInfo(): ?string
    {
        return $this->deliveryInfo;
    }

    public function setDeliveryInfo(string $deliveryInfo): static
    {
        $this->deliveryInfo = $deliveryInfo;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(Cart $cart): static
    {
        $this->cart = $cart;

        return $this;
    }

    // public function getPaiement(): ?Paiement
    // {
    //     return $this->paiement;
    // }

    // public function setPaiement(Paiement $paiement): static
    // {
    //     // set the owning side of the relation if necessary
    //     if ($paiement->getOrder1() !== $this) {
    //         $paiement->setOrder1($this);
    //     }

    //     $this->paiement = $paiement;

    //     return $this;
    // }
}
