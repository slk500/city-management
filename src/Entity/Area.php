<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Area
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public int $id;

    /**
     * @ORM\Column(type="string")
     */
    public string $name;

    /**
     * @ORM\Column(type="text")
     */
    public string $latLng;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $tags;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public ?string $description;
}