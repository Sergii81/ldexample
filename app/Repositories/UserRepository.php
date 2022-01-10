<?php

namespace App\Repositories;

use App\Models\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * @var EntityManager
     */
    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    /**
     * @param int $id
     * @return mixed|object|null
     */
    public function get(int $id)
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    /**
     * @param array $data
     * @return User
     * @throws Exception
     * @throws OptimisticLockException|ORMException
     */
    public function create(array $data): User
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(Hash::make($data['password']));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @param User $user
     * @param array $data
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(User $user, array $data): User
    {
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword(Hash::make($data['password']));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    /**
     * @param User $user
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(User $user)
    {
        $this->em->remove($user);
        $this->em->flush();
    }
}
