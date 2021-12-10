<?php

namespace App\Entity;

use App\Repository\PouletRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PouletRepository::class)
 */
class Poulet
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
    private $nbre_pondeuse;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_pchair;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbre_deces;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="poulet")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Poulailler::class, mappedBy="poulet")
     */
    private $poulaillers;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->poulaillers = new ArrayCollection();
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

    public function getNbrePondeuse(): ?int
    {
        return $this->nbre_pondeuse;
    }

    public function setNbrePondeuse(int $nbre_pondeuse): self
    {
        $this->nbre_pondeuse = $nbre_pondeuse;

        return $this;
    }

    public function getNbrePchair(): ?int
    {
        return $this->nbre_pchair;
    }

    public function setNbrePchair(int $nbre_pchair): self
    {
        $this->nbre_pchair = $nbre_pchair;

        return $this;
    }

    public function getNbreDeces(): ?int
    {
        return $this->nbre_deces;
    }

    public function setNbreDeces(int $nbre_deces): self
    {
        $this->nbre_deces = $nbre_deces;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setPoulet($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPoulet() === $this) {
                $user->setPoulet(null);
            }
        }

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
            $poulailler->setPoulet($this);
        }

        return $this;
    }

    public function removePoulailler(Poulailler $poulailler): self
    {
        if ($this->poulaillers->removeElement($poulailler)) {
            // set the owning side to null (unless already changed)
            if ($poulailler->getPoulet() === $this) {
                $poulailler->setPoulet(null);
            }
        }

        return $this;
    }
}
