<?php

namespace App\Entity;

use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WishRepository::class)
 */
class Wish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Please provide a title of your wish!")
     * @Assert\Length(min=2, max=250, minMessage = "Title has to be at least  {{ limit }} characters long!", maxMessage = "Title cannot be longer than {{ limit }} characters!")
     * @ORM\Column(type="string", length=250)
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @Assert\NotBlank(message="Please provide a author of the wish!")
     * @Assert\Length(min=2, max=50,
     *     minMessage="Author name has to be at least  {{ limit }} characters long!",
     *     maxMessage = "Author name cannot be longer than {{ limit }} characters!")
     * @ORM\Column(type="string", length=50)
     */
    private $author;

    /**
     * @ORM\Column(type="boolean", options={"default"="true"})
     */
    private $isPublished;

    /**
     * @ORM\Column(type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCreated;

    public function __construct(){
        $this->isPublished = true;
        $this->dateCreated = new \DateTime();
        /*$format = 'Y-m-d H:i:s';
        $date = new \DateTime();
        $formattedDate = $date->format($format);
        $this->dateCreated = \DateTime::createFromFormat($format, $formattedDate);*/
    }

    public function getId(): ?int
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): self
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }
}
