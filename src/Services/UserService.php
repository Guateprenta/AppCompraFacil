<?php

namespace App\Services;

use App\Repository\UserRepository;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers(): array
    {
        $users = $this->userRepository->findAll();

        return array_map(function ($user) {
            $roles = [];
            if ($user->getRol()) {
                $roles[] = $user->getRol()->getNombreRol();
            }

            foreach ($user->getRolesCollection() as $r) {
                $roles[] = $r->getNombreRol();
            }

            $roles = array_unique($roles);

            return [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'roles' => $roles,
                'tenant' => $user->getTenant() ? $user->getTenant()->getNombre() : null,
                'fechaCreacion' => $user->getFechaCreacion()->format('Y-m-d H:i:s'),
            ];
        }, $users);
    }
}
