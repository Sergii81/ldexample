<?php

namespace App\Services;

use App\Exceptions\UserNotFoundException;
use App\Models\Profile;
use App\Repositories\ProfileRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ProfileService
{
    private ProfileRepository $profileRepository;
    private UserService $userService;

    public function __construct(ProfileRepository $profileRepository, UserService $userService)
    {
        $this->profileRepository    = $profileRepository;
        $this->userService          = $userService;
    }

    /**
     * @param $userId
     * @return mixed|object|null
     * @throws UserNotFoundException
     */
    public function getByUserId($userId)
    {
        $user = $this->userService->get($userId);

        $profile = $this->profileRepository->getByUser($user);

        return $profile ?? null;
    }

    /**
     * @param int $userId
     * @param array $data
     * @return Profile
     * @throws UserNotFoundException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(int $userId, array $data): Profile
    {
        $user = $this->userService->get($userId);

        return $this->profileRepository->create($user, $data);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return Profile
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws UserNotFoundException
     */
    public function update(int $userId, array $data): Profile
    {
        $user = $this->userService->get($userId);

        $profile = $this->profileRepository->getByUser($user);

        return $profile ? $this->profileRepository->update($profile, $data) : $this->create($userId, $data);
    }
}
