<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_role')]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idrol')]
    private ?int $idRol = null;

    #[ORM\Column(name: 'nombrerol', length: 100)]
    private ?string $nombreRol = null;

    #[ORM\Column(type: 'text')]
    private ?string $descripcion = null;

    #[ORM\Column(name: 'fechacreacion', type: 'datetime')]
    private \DateTimeInterface $fechaCreacion;

    #[ORM\ManyToOne(targetEntity: Tenant::class, inversedBy: 'roles')]
    #[ORM\JoinColumn(name: 'idtenant', referencedColumnName: 'idtenant', nullable: true)]
    private ?Tenant $tenant = null;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'rolesCollection')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->fechaCreacion = new \DateTimeImmutable();
    }

    public function getIdRol(): ?int
    {
        return $this->idRol;
    }

    public function getNombreRol(): ?string
    {
        return $this->nombreRol;
    }

    public function setNombreRol(string $nombreRol): self
    {
        $this->nombreRol = $nombreRol;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaCreacion(): \DateTimeInterface
    {
        return $this->fechaCreacion;
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

    /** @return Collection<int, User> */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addRole($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeRole($this);
        }

        return $this;
    }
}
