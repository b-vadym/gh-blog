<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * @ORM\Entity()
 * @UniqueEntity(fields={"email"}, message="It looks like you already have an account!")
 */
class User implements UserInterface
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    /**
     * @var string|null
     * @SymfonyConstraints\NotBlank()
     * @SymfonyConstraints\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @var string|null
     * @SymfonyConstraints\NotBlank(groups={"Registration"})
     */
    private $plainPassword;

    /**
     * @var string[]
     * @ORM\Column(type="json_array")
     */
    private $roles = [];

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername(): ?string
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function setRoles(array $roles)
    {
        $this->roles = $roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        // leaving blank - I don't need/have a password!
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @param $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param $plainPassword
     * @return $this
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;

        return $this;
    }
}
