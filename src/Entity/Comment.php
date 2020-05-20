<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Comment
{
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public int $id;

    /**
     * @var Area
     * @ORM\ManyToOne(targetEntity="App\Entity\Area")
     * @ORM\JoinColumn(nullable=false)
     */
    public $area;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    public $body;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    public $user;

    /**
     * @ORM\Column(type="datetime")
     */
    public \DateTime $createdAt;
}
