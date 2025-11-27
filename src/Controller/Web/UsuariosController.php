<?php

namespace App\Controller\Web;

use App\Services\UserService;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/usuarios', name: 'app_usuarios_')]
final class UsuariosController extends AbstractController
{
    public function __construct(
        private InertiaInterface $inertia,
        private UserService $userService,
    ) {
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $users = $this->userService->getAllUsers();

        return $this->inertia->render('User/Users', [
            'users' => $users,
        ]);
    }
}
