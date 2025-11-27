<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'tb_tenant')]
class Tenant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'idtenant')]
    private ?int $idTenant = null;

    #[ORM\Column(length: 20)]
    private ?string $dpi = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 20)]
    private ?string $telefono = null;

    #[ORM\Column(name: 'fecha_inicio', type: 'date')]
    private ?\DateTimeInterface $fechaInicio = null;

    #[ORM\Column(type: 'text')]
    private ?string $direccion = null;

    #[ORM\Column(name: 'fecha_creacion', type: 'datetime')]
    private \DateTimeInterface $fechaCreacion;

    #[ORM\OneToMany(mappedBy: 'tenant', targetEntity: User::class)]
    private Collection $users;

    #[ORM\OneToMany(mappedBy: 'tenant', targetEntity: Role::class)]
    private Collection $roles;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->fechaCreacion = new \DateTimeImmutable();
    }

    public function getIdTenant(): ?int
    {
        return $this->idTenant;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDpi(): ?string
    {
        return $this->dpi;
    }

    public function setDpi(string $dpi): self
    {
        $this->dpi = $dpi;

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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fechaInicio;
    }

    public function setFechaInicio(\DateTimeInterface $fechaInicio): self
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getFechaCreacion(): \DateTimeInterface
    {
        return $this->fechaCreacion;
    }

    /** @return Collection<int, User> */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    /** @return Collection<int, Role> */
    public function getRoles(): Collection
    {
        return $this->roles;
    }
}
