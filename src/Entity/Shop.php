<?php

namespace App\Entity;

use App\Repository\ShopRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="category")
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Le nom est requis !")
     */
    private string $Shop;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private string $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private int $Price;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="shops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     *
     */
    public function __construct()
    {
        $this->shop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShop(): ?string
    {
        return $this->Shop;
    }

    public function setShop(string $Shop): self
    {
        $this->Shop = $Shop;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->Price;
    }

    public function setPrice(int $Price): self
    {
        $this->Price = $Price;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
