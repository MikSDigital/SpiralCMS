<?php

namespace App\Entity\Core;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="spiral_author")
 */
class Author
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", name="author_id")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64, name="author_name")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64, name="author_slug")
     */
    private $slug;

    /**
     * @ORM\Column(name="author_bio", type="string", length=500)
     */
    private $bio;

    /**
     * @ORM\Column(name="author_signature", type="string", length=128)
     */
    private $signature;

    /**
     * @ORM\Column(type="datetime", name="author_createdAt")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="author_updatedAt")
     */
    private $updatedAt;

    /**
     * Author constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->bio = $bio;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param mixed $signature
     */
    public function setSignature($signature): void
    {
        $this->signature = $signature;
    }
}