<?php

namespace Vadim\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as SymfonyConstraints;

/**
 * @ORM\Entity(repositoryClass="Vadim\BlogBundle\Repository\PostRepository")
 * @UniqueEntity(fields={"title"})
 */
class Post
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $title;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     * @SymfonyConstraints\NotBlank()
     */
    private $body;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     * @SymfonyConstraints\NotNull()
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
