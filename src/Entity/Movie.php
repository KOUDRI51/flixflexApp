<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MovieRepository::class)]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $overview = null;

    #[ORM\Column]
    private ?float $popularity = null;

    #[ORM\Column]
    private ?bool $video = null;

    #[ORM\Column]
    private ?bool $adult = null;

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

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(?string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPopularity(): ?float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): self
    {
        $this->popularity = $popularity;

        return $this;
    }

    public function isVideo(): ?bool
    {
        return $this->video;
    }

    public function setVideo(bool $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function isAdult(): ?bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }
}
