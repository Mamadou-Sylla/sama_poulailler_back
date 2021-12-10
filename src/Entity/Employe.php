<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeRepository::class)
 */
class Employe extends User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity=Poulailler::class, mappedBy="employes")
     */
    private $poulaillers;

    public function __construct()
    {
        $this->poulaillers = new ArrayCollection();
    }


    

    public function getId(): ?int
    {
        return $this->id;
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
            $poulailler->setEmployes($this);
        }

        return $this;
    }

    public function removePoulailler(Poulailler $poulailler): self
    {
        if ($this->poulaillers->removeElement($poulailler)) {
            // set the owning side to null (unless already changed)
            if ($poulailler->getEmployes() === $this) {
                $poulailler->setEmployes(null);
            }
        }

        return $this;
    }

   
}
