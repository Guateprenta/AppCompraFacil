<?php

namespace App\Controller\Web;

use App\Services\TenantService;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/empresas', name: 'app_empresas_')]
final class EmpresasController extends AbstractController
{
    public function __construct(
        private InertiaInterface $inertia,
        private TenantService $tenantService,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $tenants = $this->tenantService->getAllTenants();

        return $this->inertia->render('Tenants/Tenants', [
            'tenants' => $tenants,
        ]);
    }
}
