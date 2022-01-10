<?php

namespace App\Services;

use App\Exceptions\RoleNotFoundException;
use App\Exceptions\UserNotFoundException;
use App\Models\Role;
use App\Repositories\RoleRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class RoleService
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    /**
     * @var UserService
     */
    private UserService $userService;

    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository, UserService $userService)
    {
        $this->roleRepository = $roleRepository;
        $this->userService = $userService;
    }

    /**
     * @param int $id
     * @return mixed|object
     * @throws RoleNotFoundException
     */
    public function get(int $id)
    {
        $role = $this->roleRepository->get($id);
        if (! $role) {
            throw new RoleNotFoundException('Role not found');
        }

        return $role;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->roleRepository->getAll();
    }

    /**
     * @param array $data
     * @return Role
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(array $data): Role
    {
        return $this->roleRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Role
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws RoleNotFoundException
     */
    public function update(int $id, array $data): Role
    {
        $role = $this->get($id);

        return $this->roleRepository->update($role, $data);
    }

    /**
     * @param int $roleId
     * @param int $userId
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws RoleNotFoundException
     * @throws UserNotFoundException
     */
    public function addToUser(int $roleId, int $userId)
    {

        $user = $this->userService->get($userId);
        $role = $this->get($roleId);
        $this->roleRepository->addToUser($role, $user);

        //$role->addToUser($user);

    }
}
