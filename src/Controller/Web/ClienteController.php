<?php

namespace App\Controller\Web;

use App\Services\ClienteService;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class ClienteController extends AbstractController
{
    public function __construct(
        private InertiaInterface $inertia,
        private ClienteService $clienteService,
    ) {
    }

    #[Route('/clientes', name: 'app_clientes')]
    public function index()
    {
        $clientes = $this->clienteService->getAllClientes();

        return $this->inertia->render('Clientes/Clientes', [
            'clientes' => $clientes,
        ]);
    }

    #[Route('/clientes/nuevo', name: 'app_clientes_create', methods: ['POST'])]
    public function store(Request $request)
    {
        $data = json_decode($request->getContent(), true) ?? [];
        $this->clienteService->createCliente($data);

        return $this->redirectToRoute('app_clientes');
    }

    #[Route('/clientes/{id}', name: 'app_clientes_update', methods: ['PATCH'])]
    public function update(int $id, Request $request)
    {
        $data = json_decode($request->getContent(), true) ?? [];
        $cliente = $this->clienteService->updateCliente($id, $data);

        if (!$cliente) {
            return $this->redirectToRoute('app_clientes');
        }

        return $this->redirectToRoute('app_clientes');
    }

    #[Route('/clientes/{id}', name: 'app_clientes_delete', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $this->clienteService->deleteCliente($id);

        return $this->redirectToRoute('app_clientes');
    }
}
