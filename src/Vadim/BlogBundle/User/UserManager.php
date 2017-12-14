<?php

namespace Vadim\BlogBundle\User;

use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Vadim\BlogBundle\Entity\User;

class UserManager
{
    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @param EncoderFactoryInterface $encoderFactory
     */
    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param User $user
     */
    public function updatePassword(User $user): void
    {
        if ('' !== $password = $user->getPlainPassword()) {
            $encoder = $this->getEncoder($user);
            $user->setPassword($encoder->encodePassword($password, $user->getSalt()));
            $user->eraseCredentials();
        }
    }

    /**
     * @param User $user
     * @return PasswordEncoderInterface
     */
    protected function getEncoder(User $user): PasswordEncoderInterface
    {
        return $this->encoderFactory->getEncoder($user);
    }
}
