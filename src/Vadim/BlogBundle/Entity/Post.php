<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;
use Symfony\Component\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass="Vadim\BlogBundle\Repository\PostRepository")
 * @UniqueEntity(fields={"title"})
 */
class Post
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"full"})
     */
    protected $id;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime")
     * @SymfonyConstraints\DateTime()
     * @Gedmo\Timestampable(on="create")
     * @Serializer\Groups({"full"})
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime")
     * @SymfonyConstraints\DateTime()
     * @Gedmo\Timestampable(on="update")
     * @Serializer\Groups({"full"})
     */
    protected $updatedAt;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @SymfonyConstraints\NotBlank()
     * @Serializer\Groups({"full"})
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @SymfonyConstraints\NotBlank()
     * @Serializer\Groups({"full"})
     */
    private $body;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     * @SymfonyConstraints\NotNull()
     * @Serializer\Groups({"full"})
     */
    private $isPublished;

    /**
     * @var Category|null
     * @ORM\ManyToOne(targetEntity="Vadim\BlogBundle\Entity\Category")
     * @SymfonyConstraints\Valid()
     */
    private $category;

    /**
     * @var Collection|Tag[]
     * @ORM\ManyToMany(targetEntity="Vadim\BlogBundle\Entity\Tag")
     * @SymfonyConstraints\Valid()
     */
    private $tags;

    public function __construct()
    {
        $this->isPublished = true;
        $this->tags = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function setTitle(?string $value)
    {
        $this->title = $value;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $value
     * @return $this
     */
    public function setBody(?string $value)
    {
        $this->body = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsPublished(): bool
    {
        return $this->isPublished;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function setIsPublished(bool $value)
    {
        $this->isPublished = $value;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $value
     * @return $this
     */
    public function setCategory(?Category $value)
    {
        $this->category = $value;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Collection|Tag[] $value
     * @return $this
     */
    public function setTags($value)
    {
        $this->tags = $value;

        return $this;
    }

    /**
     * @param Tag $value
     * @return $this
     */
    public function addTag(Tag $value)
    {
        $this->tags->add($value);

        return $this;
    }

    /**
     * @param Tag $value
     * @return $this
     */
    public function removeTag(Tag $value)
    {
        $this->tags->removeElement($value);

        return $this;
    }
}
