<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="favorites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Movie", inversedBy="favorites")
     * @ORM\ManyToOne(targetEntity="TvShow", inversedBy="favorites")
     * @ORM\JoinColumn(name="favorite_id", referencedColumnName="id", nullable=false)
     * @ORM\JoinColumn(name="favorite_type", referencedColumnName="type", nullable=false)
     */
    private $favorite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getFavorite()
    {
        return $this->favorite;
    }

    public function setFavorite($favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }
}
