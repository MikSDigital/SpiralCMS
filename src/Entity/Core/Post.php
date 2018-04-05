<?php

namespace App\Entity\Core;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Core\PostRepository")
 * @ORM\Table(name="spiral_post")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="post_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, name="post_title")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true, name="post_slug")
     */
    private $slug;

    /**
     * @ORM\Column(type="text", name="post_body")
     */
    private $body;

    /**
     * @ORM\Column(type="datetime", name="post_createdAt")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="post_updatedAt")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="post_publishedAt")
     */
    private $publishedAt;

    /**
     * @ORM\Column(type="integer", name="post_status")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Author")
     * @ORM\JoinColumn(name="post_author", referencedColumnName="author_id")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=512, unique=false, name="post_extract")
     */
    private $extract;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="post_category", referencedColumnName="category_id")
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="Tag")
     * @ORM\JoinTable(name="spiral_post_tag",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="post_id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="tag_id", unique=true)}
     *      )
     */
    private $tags;

    /**
     * @ORM\Column(type="string", length=256, name="post_description")
     */
    private $description;

    /**
     * Post constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->publishedAt = null;
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getExtract()
    {
        return $this->extract;
    }

    /**
     * @param mixed $extract
     */
    public function setExtract($extract): void
    {
        $this->extract = $extract;
    }

    /**
     * @return Author
     */
    public function getAuthor(): Author
    {
        return $this->author;
    }

    /**
     * @param Author $author
     */
    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param Tag $tag
     */
    public function addTag(Tag $tag)
    {
        if ($this->tags->contains($tag)) {
            return;
        }

        $this->tags->add($tag);
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        if (!$this->tags->contains($tag)) {
            return;
        }

        $this->tags->removeElement($tag);
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * @param mixed $publishedAt
     */
    public function setPublishedAt($publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }
}
