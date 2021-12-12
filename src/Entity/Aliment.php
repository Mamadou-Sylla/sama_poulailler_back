<?php

namespace App\Entity;

use App\Repository\AlimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlimentRepository::class)
 */
class Aliment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_total;

    /**
     * @ORM\OneToMany(targetEntity=Poulailler::class, mappedBy="aliment")
     */
    private $poulailler;

    public function __construct()
    {
        $this->poulailler = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getPrixTotal(): ?string
    {
        return $this->prix_total;
    }

    public function setPrixTotal(string $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    /**
     * @return Collection|Poulailler[]
     */
    public function getPoulailler(): Collection
    {
        return $this->poulailler;
    }

    public function addPoulailler(Poulailler $poulailler): self
    {
        if (!$this->poulailler->contains($poulailler)) {
            $this->poulailler[] = $poulailler;
            $poulailler->setAliment($this);
        }

        return $this;
    }

    public function removePoulailler(Poulailler $poulailler): self
    {
        if ($this->poulailler->removeElement($poulailler)) {
            // set the owning side to null (unless already changed)
            if ($poulailler->getAliment() === $this) {
                $poulailler->setAliment(null);
            }
        }

        return $this;
    }
}
