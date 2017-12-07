<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * @ORM\Entity(repositoryClass="Vadim\BlogBundle\Repository\TagRepository")
 * @UniqueEntity(fields={"name"})
 */
class Tag
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $name;

    public function __toString()
    {
        return (string) $this->getName();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function setName(?string $value)
    {
        $this->name = $value;

        return $this;
    }
}
