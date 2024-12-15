<?php

namespace App\Entity;

use App\Repository\CannabisProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CannabisProductRepository::class)]
class CannabisProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $thcContent = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $cbdContent = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    /**
     * @var Collection<int, CannabisProductRating>
     */
    #[ORM\OneToMany(targetEntity: CannabisProductRating::class, mappedBy: 'product', orphanRemoval: true)]
    private Collection $ratings;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?CannabisProducer $producer = null;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getThcContent(): ?string
    {
        return $this->thcContent;
    }

    public function setThcContent(string $thcContent): static
    {
        $this->thcContent = $thcContent;

        return $this;
    }

    public function getCbdContent(): ?string
    {
        return $this->cbdContent;
    }

    public function setCbdContent(string $cbdContent): static
    {
        $this->cbdContent = $cbdContent;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): static
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return Collection<int, CannabisProductRating>
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(CannabisProductRating $rating): static
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings->add($rating);
            $rating->setProduct($this);
        }

        return $this;
    }

    public function removeRating(CannabisProductRating $rating): static
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getProduct() === $this) {
                $rating->setProduct(null);
            }
        }

        return $this;
    }

    public function getProducer(): ?CannabisProducer
    {
        return $this->producer;
    }

    public function setProducer(?CannabisProducer $producer): static
    {
        $this->producer = $producer;

        return $this;
    }
}
