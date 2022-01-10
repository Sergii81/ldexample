<?php

namespace App\Models;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
 * @ORM\Entity
 * @ORM\Table(name="profiles")
 */
class Profile extends Model
{
    use HasFactory, Timestamps;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", name="first_name", nullable=true)
     */
    private string $firstName;

    /**
     * @ORM\Column(type="string", name="last_name", nullable=true)
     */
    private string $lastMame;

    /**
     * @var DateTime
     * @ORM\Column(type="datetime", nullable=true)
     */
    private DateTime $birthday;

    /**
     * @ORM\OneToOne(targetEntity="User", inversedBy="profile")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private User $user;

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
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastMame;
    }

    /**
     * @return DateTime
     */
    public function getBirthday(): DateTime
    {
        return $this->birthday;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
     * @param $firstName
     * @return $this
     */
    public function setFirstName($firstName): Profile
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @param $lastMame
     * @return $this
     */
    public function setLastName($lastMame): Profile
    {
        $this->lastMame = $lastMame;

        return $this;
    }

    /**
     * @param $birthday
     * @return $this
     * @throws \Exception
     */
    public function setBirthday($birthday): Profile
    {
        $this->birthday = new DateTime($birthday);

        return $this;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): Profile
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt): Profile
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user): Profile
    {
        $this->user = $user;

        return $this;
    }







}
