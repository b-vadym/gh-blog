<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

trait TimestampableEntityTrait
{
    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime")
     * @SymfonyConstraints\DateTime()
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime")
     * @SymfonyConstraints\DateTime()
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * @param \DateTime|null $value
     * @return $this
     */
    public function setCreatedAt(?\DateTime $value)
    {
        $this->createdAt = $value;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $value
     * @return $this
     */
    public function setUpdatedAt(?\DateTime $value)
    {
        $this->updatedAt = $value;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }
}
