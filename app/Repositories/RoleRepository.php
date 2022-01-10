<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class RoleRepository
{
    /**
     * @var EntityManager
     */
    private EntityManager $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param int $id
     * @return mixed|object|null
     */
    public function get(int $id)
    {
        return $this->em->getRepository(Role::class)->find($id);
    }

    /**
     * @return array|object[]
     */
    public function getAll(): array
    {
        return $this->em->getRepository(Role::class)->findAll();
    }

    /**
     * @param array $data
     * @return Role
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(array $data): Role
    {
        $role = new Role();
        $role->setName($data['name']);

        $this->em->persist($role);
        $this->em->flush();

        return $role;
    }

    /**
     * @param Role $role
     * @param array $data
     * @return Role
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Role $role, array $data): Role
    {
        $role->setName($data['name']);

        $this->em->persist($role);
        $this->em->flush();

        return $role;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function addToUser(Role $role, User $user)
    {
        $role->addToUser($user);
        $this->em->persist($role);
        $this->em->flush();
    }
}
