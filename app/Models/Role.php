<?php

namespace App\Models;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="roles")
 */
class Role
{
    use HasFactory, Timestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * Many Roles have Many Users
     * @ORM\ManyToMany(targetEntity="App\Models\User", mappedBy="roles")
     *
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setName($name): Role
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): Role
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt): Role
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function addToUser(User $user): Role
    {
       if(! $this->users->contains($user)) {
           //$this->users[] = $user;
           $this->users->add($user);
           $user->addRole($this);
       }

       return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function removeUser(User $user): Role
    {
        if(! $this->users->contains($user)) {
            $this->users->removeElement($user);
            $user->removeRole($this);
        }

        return $this;
    }
}
