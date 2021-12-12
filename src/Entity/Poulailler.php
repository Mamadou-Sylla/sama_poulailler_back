<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PoulaillerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PoulaillerRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read", "employe:read"}},
 *     denormalizationContext={"groups"={"user:write", "employe:write"}},
 *     routePrefix="/poulailler",
 *     attributes={
 *      "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYE')",
 *      "security_message"="Vous n'avez pas acces à ce ressource",
 *      "pagination_items_per_page"=10
 * },
 *     collectionOperations={
 *     "get"={"path"=""},
 *      "post"={"path"=""} 
 *      },
 *      itemOperations={
 *     "get"={"path"="/{id}"},
 *     "put"={"path"="/{id}"},
 *     "delete"={"method"="DELETE", "path"="/{id}", "route_name"="delete_user"}
 *     }
 * )
 */
class Poulailler
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"puser:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"puser:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="date")
     * @Groups({"puser:read"})
     */
    private $date_debut;

    /**
     * @ORM\Column(type="date", nullable=true)
     * @Groups({"puser:read"})
     */
    private $date_fin;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"puser:read"})
     */
    private $archived = false;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="poulailler")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Poulet::class, inversedBy="poulaillers")
     */
    private $poulet;

    /**
     * @ORM\ManyToOne(targetEntity=Poussin::class, inversedBy="poulaillers")
     */
    private $poussin;

    /**
     * @ORM\ManyToOne(targetEntity=Employe::class, inversedBy="poulaillers")
     */
    private $employes;

    /**
     * @ORM\ManyToOne(targetEntity=Medicament::class, inversedBy="poulailler")
     */
    private $medicament;

    /**
     * @ORM\ManyToOne(targetEntity=Aliment::class, inversedBy="poulailler")
     */
    private $aliment;

    /**
     * @ORM\ManyToOne(targetEntity=Depense::class, inversedBy="poulailler")
     */
    private $depense;

    /**
     * @ORM\ManyToOne(targetEntity=Vente::class, inversedBy="poulaillers")
     */
    private $vente;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

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
            $user->setPoulailler($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getPoulailler() === $this) {
                $user->setPoulailler(null);
            }
        }

        return $this;
    }

    public function getPoulet(): ?Poulet
    {
        return $this->poulet;
    }

    public function setPoulet(?Poulet $poulet): self
    {
        $this->poulet = $poulet;

        return $this;
    }

    public function getPoussin(): ?Poussin
    {
        return $this->poussin;
    }

    public function setPoussin(?Poussin $poussin): self
    {
        $this->poussin = $poussin;

        return $this;
    }

    public function getEmployes(): ?Employe
    {
        return $this->employes;
    }

    public function setEmployes(?Employe $employes): self
    {
        $this->employes = $employes;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }

    public function getAliment(): ?Aliment
    {
        return $this->aliment;
    }

    public function setAliment(?Aliment $aliment): self
    {
        $this->aliment = $aliment;

        return $this;
    }

    public function getDepense(): ?Depense
    {
        return $this->depense;
    }

    public function setDepense(?Depense $depense): self
    {
        $this->depense = $depense;

        return $this;
    }

    public function getVente(): ?Vente
    {
        return $this->vente;
    }

    public function setVente(?Vente $vente): self
    {
        $this->vente = $vente;

        return $this;
    }
}
