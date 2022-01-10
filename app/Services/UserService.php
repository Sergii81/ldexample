<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->userRepository->getAll();
    }

    /**
     * @param int $id
     * @return mixed|object|null
     * @throws UserNotFoundException
     */
    public function get(int $id)
    {
        $user = $this->userRepository->get($id);
        if (! $user) {
            throw new UserNotFoundException('User not found');
        }

        return $user;
    }

    /**
     * @param array $data
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(array $data): User
    {
        return $this->userRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException|UserNotFoundException
     */
    public function update(int $id, array $data): User
    {
        $user = $this->get($id);

        return $this->userRepository->update($user, $data);
    }

    /**
     * @param int $id
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws UserNotFoundException
     */
    public function delete(int $id)
    {
        $user = $this->get($id);

        $this->userRepository->delete($user);
    }
}
