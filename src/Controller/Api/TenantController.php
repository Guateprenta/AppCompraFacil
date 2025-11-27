<?php

namespace App\Controller\Api;

use App\Services\TenantService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/tenants', name: 'api_tenants_')]
class TenantController extends AbstractController
{
    private TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $tenants = $this->tenantService->getAllTenants();

        return $this->json($tenants);
    }

    #[Route('/{id}', name: 'get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $tenant = $this->tenantService->getTenantById($id);

        if (!$tenant) {
            return $this->json(['error' => 'Tenant no encontrado'], 404);
        }

        return $this->json($tenant);
    }
}
