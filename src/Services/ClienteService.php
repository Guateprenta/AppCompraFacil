<?php

namespace App\Services;

use App\Repository\ClienteRepository;

class ClienteService
{
    public function __construct(private ClienteRepository $clienteRepository)
    {
    }

    public function getAllClientes(): array
    {
        $clientes = $this->clienteRepository->findAll();

        return array_map(fn ($c) => [
            'id' => $c->getIdCliente(),
            'nombre' => $c->getNombre(),
            'apellido' => $c->getApellido(),
            'email' => $c->getEmail(),
            'telefono' => $c->getTelefono(),
            'direccion' => $c->getDireccion(),
            'dpi' => $c->getDpi(),
            'fechaCreacion' => $c->getFechaCreacion()->format('Y-m-d H:i:s'),
        ], $clientes);
    }

    public function createCliente(array $data): void
    {
        $cliente = new \App\Entity\Cliente();
        $cliente->setNombre($data['nombre']);
        $cliente->setApellido($data['apellido']);
        $cliente->setEmail($data['email']);
        $cliente->setTelefono($data['telefono']);
        $cliente->setDireccion($data['direccion']);
        $cliente->setDpi($data['dpi']);
        $cliente->setFechaCreacion(new \DateTime());

        $this->clienteRepository->getEntityManager()->persist($cliente);
        $this->clienteRepository->getEntityManager()->flush();
    }

    public function updateCliente(int $id, array $data): ?\App\Entity\Cliente
    {
        $cliente = $this->clienteRepository->find($id);
        if (!$cliente) {
            return null;
        }

        if (isset($data['nombre'])) {
            $cliente->setNombre($data['nombre']);
        }
        if (isset($data['apellido'])) {
            $cliente->setApellido($data['apellido']);
        }
        if (isset($data['email'])) {
            $cliente->setEmail($data['email']);
        }
        if (isset($data['telefono'])) {
            $cliente->setTelefono($data['telefono']);
        }
        if (isset($data['direccion'])) {
            $cliente->setDireccion($data['direccion']);
        }
        if (isset($data['dpi'])) {
            $cliente->setDpi($data['dpi']);
        }

        $this->clienteRepository->getEntityManager()->flush();

        return $cliente;
    }

    public function deleteCliente(int $id): bool
    {
        $cliente = $this->clienteRepository->find($id);

        if (!$cliente) {
            return false;
        }

        $em = $this->clienteRepository->getEntityManager();
        $em->remove($cliente);
        $em->flush();

        return true;
    }
}
