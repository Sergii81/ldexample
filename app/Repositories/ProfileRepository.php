<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Models\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ProfileRepository
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
     * @param User $user
     * @return mixed|object|null
     */
    public function getByUser(User $user)
    {
        return $this->em->getRepository(Profile::class)->findOneBy(['user' => $user->getId()]);
    }

    /**
     * @param array $data
     * @param User $user
     * @return Profile
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(User $user, array $data): Profile
    {
        $profile = new Profile();
        $profile->setFirstName($data['firstName']);
        $profile->setLastName($data['lastName']);
        $profile->setBirthday($data['birthday']);

        $this->em->persist($profile);

        $user->addProfile($profile);

        $this->em->flush();

        return $profile;
    }

    /**
     * @param Profile $profile
     * @param array $data
     * @return Profile
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Profile $profile, array $data): Profile
    {
        $profile->setFirstName($data['firstName']);
        $profile->setLastName($data['lastName']);
        $profile->setBirthday($data['birthday']);

        $this->em->persist($profile);
        $this->em->flush();

        return $profile;
    }
}
