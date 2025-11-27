<?php

namespace App\Controller\Api;

use App\Services\RoleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/roles', name: 'api_roles_')]
class RoleController extends AbstractController
{
    private RoleService $roleService;

    public function __construct(RoleService $roleService)
    {
        $this->roleService = $roleService;
    }

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $roles = $this->roleService->getAllRoles();

        return $this->json($roles);
    }

    #[Route('/{id}', name: 'get', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $role = $this->roleService->getRoleById($id);

        if (!$role) {
            return $this->json(['error' => 'Rol no encontrado'], 404);
        }

        return $this->json($role);
    }
}
