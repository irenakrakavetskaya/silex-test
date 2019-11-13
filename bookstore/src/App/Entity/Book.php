<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 * @ORM\Table(name="books")
 */
class Book extends Entity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * Many books have Many authors.
     * @ManyToMany(targetEntity="Author", inversedBy="books")
     * @JoinTable(name="books_authors")
     */
    protected $authors;

    /**
     * Many books belongs to Many orders.
     * @ManyToMany(targetEntity="Order", inversedBy="books")
     * @JoinTable(name="books_orders")
     */
    protected $orders;

    public function __construct() {
        $this->authors = new ArrayCollection();
        $this->orders = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }
}

