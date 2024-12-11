<?php

namespace App\Entity;

use App\Repository\CannabisProductRatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CannabisProductRatingRepository::class)]
class CannabisProductRating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ratings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CannabisProduct $product = null;

    #[ORM\Column]
    private ?int $quality = null;

    #[ORM\Column]
    private ?int $effect = null;

    #[ORM\Column]
    private ?int $safety = null;

    #[ORM\Column]
    private ?int $reliability = null;

    #[ORM\Column]
    private ?int $pricePerformance = null;

    #[ORM\Column]
    private ?int $trust = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?CannabisProduct
    {
        return $this->product;
    }

    public function setProduct(?CannabisProduct $product): static
    {
        $this->product = $product;

        return $this;
    }

    public function getQuality(): ?int
    {
        return $this->quality;
    }

    public function setQuality(int $quality): static
    {
        $this->quality = $quality;

        return $this;
    }

    public function getEffect(): ?int
    {
        return $this->effect;
    }

    public function setEffect(int $effect): static
    {
        $this->effect = $effect;

        return $this;
    }

    public function getSafety(): ?int
    {
        return $this->safety;
    }

    public function setSafety(int $safety): static
    {
        $this->safety = $safety;

        return $this;
    }

    public function getReliability(): ?int
    {
        return $this->reliability;
    }

    public function setReliability(int $reliability): static
    {
        $this->reliability = $reliability;

        return $this;
    }

    public function getPricePerformance(): ?int
    {
        return $this->pricePerformance;
    }

    public function setPricePerformance(int $pricePerformance): static
    {
        $this->pricePerformance = $pricePerformance;

        return $this;
    }

    public function getTrust(): ?int
    {
        return $this->trust;
    }

    public function setTrust(int $trust): static
    {
        $this->trust = $trust;

        return $this;
    }
}
