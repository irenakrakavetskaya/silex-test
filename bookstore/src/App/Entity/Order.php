<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 * @ORM\Table(name="orders")
 */
class Order extends Entity
{
    const STATUS_PENDING = 0;
    const STATUS_PROCESSED = 1;
    const STATUS_DELIVERED = 2;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", columnDefinition="ENUM(0, 1, 2)")
     * @Assert\NotBlank()
     */
    private $status;

    /**
     * @ORM\Column(type="datetimetz")
     * @Assert\NotBlank()
     * @Assert\Datetimetz()
     */
    private $datetime;

    /**
     * Many Orders have One User
     * @ManyToOne(targetEntity="User", inversedBy="orders")
     * @JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * Many Orders have Many Books.
     * @ManyToMany(targetEntity="Book",  mappedBy="orders")
     * @JoinTable(name="books_orders")
     */
    protected $books;

    public function __construct() {
        $this->books = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status)
    {
        if (!in_array($status, array(self::STATUS_PENDING, self::STATUS_PROCESSED, self::STATUS_DELIVERED))) {
            throw new \InvalidArgumentException("Invalid status");
        }
        $this->status = $status;
    }

    public function getDatetime(): string
    {
        return $this->datetime;
    }

    public function setDatetime(string $datetime)
    {
        $this->datetime = $datetime;
    }
}