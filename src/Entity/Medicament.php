<?php

namespace App\Entity;

use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
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
     * @ORM\Column(type="string", length=255)
     */
    private $quantite;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix_total;

    /**
     * @ORM\OneToMany(targetEntity=Poulailler::class, mappedBy="medicament")
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
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
    public function getPoulailler(): Collection
    {
        return $this->poulailler;
    }

    public function addPoulailler(Poulailler $poulailler): self
    {
        if (!$this->poulailler->contains($poulailler)) {
            $this->poulailler[] = $poulailler;
            $poulailler->setMedicament($this);
        }

        return $this;
    }

    public function removePoulailler(Poulailler $poulailler): self
    {
        if ($this->poulailler->removeElement($poulailler)) {
            // set the owning side to null (unless already changed)
            if ($poulailler->getMedicament() === $this) {
                $poulailler->setMedicament(null);
            }
        }

        return $this;
    }
}
