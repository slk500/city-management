<?php

declare(strict_types=1);

namespace App\Form\Dto;


use App\Entity\Project;

class ProjectDto
{
    public ?string $name = null;

    public ?string $latLng = null;

    public ?string $tags = null;

    public ?string $status = null;

    public ?string $description = null;

    public static function fromEntity(Project $area = null): self
    {
        $self = new self();

        if (null === $area) {
            return $self;
        }

        $self->name = $area->name;
        $self->latLng = $area->latLng;
        $self->tags = $area->tags;
        $self->status = $area->status;
        $self->description = $area->description;

        return $self;
    }

    public function toEntity(Project $area = null): Project
    {
        if (null === $area) {
            $area = new Project();
        }

        $area->name = $this->name;
        $area->latLng = $this->latLng;
        $area->tags = $this->tags;
        $area->status = $this->status;
        $area->description = $this->description;

        return $area;
    }
}