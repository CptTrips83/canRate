<?php

namespace App\Entity;

use App\Repository\CannabisProducerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CannabisProducerRepository::class)]
class CannabisProducer
{
    public function __toString(): string
    {
        return $this->getName();
    }

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, CannabisProduct>
     */
    #[ORM\OneToMany(targetEntity: CannabisProduct::class, mappedBy: 'producer')]
    private Collection $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, CannabisProduct>
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(CannabisProduct $product): static
    {
        if (!$this->products->contains($product)) {
            $this->products->add($product);
            $product->setProducer($this);
        }

        return $this;
    }

    public function removeProduct(CannabisProduct $product): static
    {
        if ($this->products->removeElement($product)) {
            // set the owning side to null (unless already changed)
            if ($product->getProducer() === $this) {
                $product->setProducer(null);
            }
        }

        return $this;
    }
}
