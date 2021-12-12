<?php

namespace App\Entity;

use App\Repository\VenteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VenteRepository::class)
 */
class Vente
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
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_total;

    /**
     * @ORM\OneToMany(targetEntity=Poulailler::class, mappedBy="vente")
     */
    private $poulaillers;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    public function __construct()
    {
        $this->poulaillers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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

    public function getPrixTotal(): ?int
    {
        return $this->prix_total;
    }

    public function setPrixTotal(int $prix_total): self
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    /**
     * @return Collection|Poulailler[]
     */
    public function getPoulaillers(): Collection
    {
        return $this->poulaillers;
    }

    public function addPoulailler(Poulailler $poulailler): self
    {
        if (!$this->poulaillers->contains($poulailler)) {
            $this->poulaillers[] = $poulailler;
            $poulailler->setVente($this);
        }

        return $this;
    }

    public function removePoulailler(Poulailler $poulailler): self
    {
        if ($this->poulaillers->removeElement($poulailler)) {
            // set the owning side to null (unless already changed)
            if ($poulailler->getVente() === $this) {
                $poulailler->setVente(null);
            }
        }

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
