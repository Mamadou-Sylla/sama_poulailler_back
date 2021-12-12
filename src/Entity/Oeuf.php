<?php

namespace App\Entity;

use App\Repository\OeufRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OeufRepository::class)
 */
class Oeuf
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_casses;

    /**
     * @ORM\OneToMany(targetEntity=Poulet::class, mappedBy="oeuf")
     */
    private $poulet;

    public function __construct()
    {
        $this->poulet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbreTotal(): ?int
    {
        return $this->nbre_total;
    }

    public function setNbreTotal(int $nbre_total): self
    {
        $this->nbre_total = $nbre_total;

        return $this;
    }

    public function getNbreCasses(): ?int
    {
        return $this->nbre_casses;
    }

    public function setNbreCasses(int $nbre_casses): self
    {
        $this->nbre_casses = $nbre_casses;

        return $this;
    }

    /**
     * @return Collection|Poulet[]
     */
    public function getPoulet(): Collection
    {
        return $this->poulet;
    }

    public function addPoulet(Poulet $poulet): self
    {
        if (!$this->poulet->contains($poulet)) {
            $this->poulet[] = $poulet;
            $poulet->setOeuf($this);
        }

        return $this;
    }

    public function removePoulet(Poulet $poulet): self
    {
        if ($this->poulet->removeElement($poulet)) {
            // set the owning side to null (unless already changed)
            if ($poulet->getOeuf() === $this) {
                $poulet->setOeuf(null);
            }
        }

        return $this;
    }
}
