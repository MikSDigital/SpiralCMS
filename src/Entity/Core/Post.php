<?php

namespace App\Entity\Core;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", , name="post_id")
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
     * @ORM\Column(type="integer", name="post_status")
     */
    private $status;

    /**
     * @ORM\Column(type="integer", name="post_commentStatus")
     */
    private $commentStatus;

    /**
     * @ORM\Column(type="string", length=255, unique=true, name="post_extract")
     */
    private $extract;

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
    public function getCommentStatus()
    {
        return $this->commentStatus;
    }

    /**
     * @param mixed $commentStatus
     */
    public function setCommentStatus($commentStatus): void
    {
        $this->commentStatus = $commentStatus;
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
}
