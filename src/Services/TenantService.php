<?php

namespace App\Services;

use App\Repository\TenantRepository;

class TenantService
{
    private TenantRepository $tenantRepository;

    public function __construct(TenantRepository $tenantRepository)
    {
        $this->tenantRepository = $tenantRepository;
    }

    public function getAllTenants(): array
    {
        $tenants = $this->tenantRepository->findAll();

        return array_map(fn ($tenant) => [
            'idTenant' => $tenant->getIdTenant(),
            'dpi' => $tenant->getDpi(),
            'nombre' => $tenant->getNombre(),
            'email' => $tenant->getEmail(),
            'telefono' => $tenant->getTelefono(),
            'fechaInicio' => $tenant->getFechaInicio()->format('Y-m-d'),
            'direccion' => $tenant->getDireccion(),
            'fechaCreacion' => $tenant->getFechaCreacion()->format('Y-m-d H:i:s'),
        ], $tenants);
    }

    public function getTenantById(int $id): ?array
    {
        $tenant = $this->tenantRepository->find($id);

        if (!$tenant) {
            return null;
        }

        return [
            'idTenant' => $tenant->getIdTenant(),
            'dpi' => $tenant->getDpi(),
            'nombre' => $tenant->getNombre(),
            'email' => $tenant->getEmail(),
            'telefono' => $tenant->getTelefono(),
            'fechaInicio' => $tenant->getFechaInicio()->format('Y-m-d'),
            'direccion' => $tenant->getDireccion(),
            'fechaCreacion' => $tenant->getFechaCreacion()->format('Y-m-d H:i:s'),
        ];
    }
}
