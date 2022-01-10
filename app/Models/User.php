<?php

namespace App\Models;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\DateTimeTzImmutableType;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use LaravelDoctrine\Extensions\Timestamps\Timestamps;

/**
* @ORM\Entity
* @ORM\Table(name="users")
*/
class User /*extends Authenticatable*/
{
    use HasApiTokens, HasFactory, Notifiable, Timestamps;

//    /**
//     * The attributes that are mass assignable.
//     *
//     * @var array<int, string>
//     */
//    private $fillable = [
//        'name',
//        'email',
//        'password',
//    ];
//
//    /**
//     * The attributes that should be hidden for serialization.
//     *
//     * @var array<int, string>
//     */
//    private $hidden = [
//        'password',
//        'remember_token',
//    ];
//
//    /**
//     * The attributes that should be cast.
//     *
//     * @var array<string, string>
//     */
//    private $casts = [
//        'email_verified_at' => 'datetime',
//    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private string $email;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private string $email_verified_at;

    /**
     * @ORM\Column(type="string")
     */
    private string $password;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private string $remember_token;

    /**
     * @ORM\OneToOne(targetEntity="Profile", mappedBy="user")
     */
    private Profile $profile;

    /**
     * Many Users have Many Roles
     * @ORM\ManyToMany(targetEntity="App\Models\Role", inversedBy="users")
     * @ORM\JoinTable(name="role_user",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *     )
     *
     */
    private $roles;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
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
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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
     * @return Profile|null
     */
    public function getProfile(): ?Profile
    {
        return $this->profile ?? null;
    }

    /**
     * @param $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email): User
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password): User
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt): User
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt): User
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @param Profile $profile
     * @return $this
     */
    public function addProfile(Profile $profile): User
    {
        $this->profile = $profile;
        $profile->setUser($this);

        return $this;
    }

    /**
     * @param Profile $profile
     * @return void
     */
    public function removeProfile(Profile $profile)
    {
        $this->profile->remove($profile);
    }


    public function getRoles()
    {
        foreach ($this->roles as $role) {
            return $role->getName();
        }
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function addRole(Role $role): User
    {
        if(!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addToUser($this);
        }

        return $this;
    }

    /**
     * @param Role $role
     * @return $this
     */
    public function removeRole(Role $role): User
    {
        if($this->roles->contains($role)) {
            $this->roles->removeElement($role);
            $role->removeUser($this);
        }

        return $this;
    }
}
