<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'tb_user')]
#[ORM\UniqueConstraint(name: 'uniq_identifier_email', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idusuario')]
    private ?int $id = null;

    #[ORM\Column(name: 'nombreuser', length: 50, nullable: true)]
    private ?string $username = null;

    #[ORM\Column(length: 50, unique: true)]
    private ?string $email = null;

    #[ORM\Column(name: 'contrasena', length: 255)]
    private ?string $password = null;

    #[ORM\Column(name: 'fechacreacion', type: 'datetime')]
    private ?\DateTimeInterface $fechaCreacion = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(name: 'idtenant', referencedColumnName: 'idtenant', nullable: false)]
    private ?Tenant $tenant = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'idrol', referencedColumnName: 'idrol', nullable: true)]
    private ?Role $rol = null;

    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'users')]
    #[ORM\JoinTable(
        name: 'tb_user_roles',
        joinColumns: [new ORM\JoinColumn(name: 'idusuario', referencedColumnName: 'idusuario')],
        inverseJoinColumns: [new ORM\JoinColumn(name: 'idrol', referencedColumnName: 'idrol')]
    )]
    private Collection $rolesCollection;

    public function __construct()
    {
        $this->rolesCollection = new ArrayCollection();
        $this->fechaCreacion = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(?string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getFechaCreacion(): ?\DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion(\DateTimeInterface $fecha): self
    {
        $this->fechaCreacion = $fecha;

        return $this;
    }

    public function getRoles(): array
    {
        $roles = [];

        if ($this->rol) {
            $roles[] = $this->rol->getNombreRol();
        }

        foreach ($this->rolesCollection as $roleEntity) {
            $roles[] = $roleEntity->getNombreRol();
        }

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials(): void
    {
    }

    public function getTenant(): ?Tenant
    {
        return $this->tenant;
    }

    public function setTenant(?Tenant $tenant): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getRol(): ?Role
    {
        return $this->rol;
    }

    public function setRol(?Role $rol): self
    {
        $this->rol = $rol;

        return $this;
    }

    /** @return Collection<int, Role> */
    public function getRolesCollection(): Collection
    {
        return $this->rolesCollection;
    }

    public function addRole(Role $role): self
    {
        if (!$this->rolesCollection->contains($role)) {
            $this->rolesCollection->add($role);
            $role->addUser($this);
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        if ($this->rolesCollection->removeElement($role)) {
            $role->removeUser($this);
        }

        return $this;
    }
}
