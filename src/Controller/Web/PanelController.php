<?php

namespace App\Controller\Web;

use App\Services\UserService;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PanelController extends AbstractController
{
    public function __construct(private InertiaInterface $inertia, private UserService $userService)
    {
    }

    #[Route('/panel', name: 'app_panel')]
    public function index(): Response
    {
        $users = $this->userService->getAllUsers();

        return $this->inertia->render('Panel/Panel', [
            'users' => $users,
        ]);
    }
}
