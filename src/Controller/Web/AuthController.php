<?php

namespace App\Controller\Web;

use App\Repository\UserRepository;
use Rompetomp\InertiaBundle\Architecture\InertiaInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

final class AuthController extends AbstractController
{
    public function __construct(
        private InertiaInterface $inertia,
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
    ) {
    }

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request)
    {
        $session = $request->getSession();

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $email = $data['email'] ?? null;
            $password = $data['password'] ?? null;

            $user = $this->userRepository->findOneBy(['email' => $email]);

            if (!$user || !$this->passwordHasher->isPasswordValid($user, $password)) {
                return $this->inertia->render('Auth/Login', [
                    'initialError' => 'Credenciales inválidas',
                    'initialEmail' => $email,
                ]);
            }

            $session->set('user_id', $user->getId());

            return $this->inertia->location('/panel');
        }

        return $this->inertia->render('Auth/Login');
    }
}
