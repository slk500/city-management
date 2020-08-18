<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Project
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
     * @ORM\Column(type="text", nullable=true)
     */
    public ?string $latLng;

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

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $coordinator;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $phone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    public ?string $link;

    /**
     * @ORM\Column(type="string")
     */
    public string $committee;

    /**
     * @ORM\Column(type="string")
     */
    public string $district;
}