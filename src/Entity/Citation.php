<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CitationRepository")
 */
class Citation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\film")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\personnage")
     * @ORM\JoinColumn(nullable=false)
     */
    private $personnage;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $citation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFilm(): ?film
    {
        return $this->film;
    }

    public function setFilm(?film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getPersonnage(): ?personnage
    {
        return $this->personnage;
    }

    public function setPersonnage(?personnage $personnage): self
    {
        $this->personnage = $personnage;

        return $this;
    }

    public function getCitation(): ?string
    {
        return $this->citation;
    }

    public function setCitation(string $citation): self
    {
        $this->citation = $citation;

        return $this;
    }
}
