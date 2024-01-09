<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: produit::class, inversedBy: 'categories')]
    private Collection $id_Produit;

    public function __construct()
    {
        $this->id_Produit = new ArrayCollection();
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
     * @return Collection<int, produit>
     */
    public function getIdProduit(): Collection
    {
        return $this->id_Produit;
    }

    public function addIdProduit(produit $idProduit): static
    {
        if (!$this->id_Produit->contains($idProduit)) {
            $this->id_Produit->add($idProduit);
        }

        return $this;
    }

    public function removeIdProduit(produit $idProduit): static
    {
        $this->id_Produit->removeElement($idProduit);

        return $this;
    }
}
