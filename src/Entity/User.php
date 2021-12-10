<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type",  type="string")
 * @ORM\DiscriminatorMap({"admin"="User", "employe" = "Employe"})
 * @UniqueEntity(
 * fields={"email"},
 * message="L'email doit être unique"
 * )
 * @ApiFilter(RangeFilter::class, properties={"isDeleted"})
 * @ApiResource(
 *     normalizationContext={"groups"={"user:read"}},
 *     denormalizationContext={"groups"={"user:write"}},
 *     routePrefix="/users",
 *     attributes={
 *      "security"="is_granted('ROLE_ADMIN') or is_granted('ROLE_EMPLOYE')",
 *      "security_message"="Vous n'avez pas acces à ce ressource",
 *      "pagination_items_per_page"=10
 * },
 *     collectionOperations={
 *     "get"={"path"=""},
 *      "post"={"method"="POST", "path"="", "route_name"="post_user"} 
 *      },
 *      itemOperations={
 *     "get"={"path"="/{id}"},
 *     "get_psuer"={"method"="GET", "path"="/{id}/poulailler", "normalization_context" = {"groups"={"puser:read"}}},
 *     "put"={"method"="PUT", "path"="/{id}", "route_name"="edit_user"},
 *     "delete"={"method"="DELETE", "path"="/{id}", "route_name"="delete_user"}
 *     }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:read", "puser:read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "puser:read"})
     * @Assert\NotBlank(message="Le prenom est obligatoire")
     */
    protected $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "puser:read"})
     * @Assert\NotBlank(message="Le nom est obligatoire")
     */
    protected $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "puser:read"})
     * @Assert\NotBlank(message="L'email est obligatoire")
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read", "user:write", "puser:read"})
     * @Assert\NotBlank(message="Le numero de telephone est obligatoire")
     */
    protected $telephone;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups({"user:read", "user:write", "puser:read"})
     */
    protected $photo;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le mot de passe est obligatoire")
     * @Groups({"user:write"})
     */
    protected $password;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"user:read", "user:write"})
     */
    protected $isDeleted = false;

    /**
     * @ORM\Column(type="array")
     * @Groups({"user:read", "user:write", "puser:read"})
     */
    protected $roles = [];

   
    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups({"user:read", "user:write", "puser:read"})
     */
    protected $profil;

    /**
     * @ORM\ManyToOne(targetEntity=Poulailler::class, inversedBy="users")
     * @Groups({"puser:read"})
     */
    protected $poulailler;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }

     /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_'.$this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getPoulailler(): ?Poulailler
    {
        return $this->poulailler;
    }

    public function setPoulailler(?Poulailler $poulailler): self
    {
        $this->poulailler = $poulailler;

        return $this;
    }

  
}
