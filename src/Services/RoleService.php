<?php

namespace App\Services;

use App\Repository\RoleRepository;

class RoleService
{
    private RoleRepository $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getAllRoles(): array
    {
        $roles = $this->roleRepository->findAll();

        return array_map(fn ($role) => [
            'idRol' => $role->getIdRol(),
            'nombreRol' => $role->getNombreRol(),
            'descripcion' => $role->getDescripcion(),
            'fechaCreacion' => $role->getFechaCreacion()->format('Y-m-d H:i:s'),
            'tenant' => $role->getTenant() ? $role->getTenant()->getNombre() : null,
        ], $roles);
    }

    public function getRoleById(int $id): ?array
    {
        $role = $this->roleRepository->find($id);

        if (!$role) {
            return null;
        }

        return [
            'idRol' => $role->getIdRol(),
            'nombreRol' => $role->getNombreRol(),
            'descripcion' => $role->getDescripcion(),
            'fechaCreacion' => $role->getFechaCreacion()->format('Y-m-d H:i:s'),
            'tenant' => $role->getTenant() ? $role->getTenant()->getNombre() : null,
        ];
    }
}
