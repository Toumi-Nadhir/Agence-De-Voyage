<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=LocationRepository::class)
 */
class Location
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Expression(
     *     "this.getDateDebut() < this.getDateFin()",
     *     message="La date de depart ne doit pas être postérieure à la date d'arrive"
     * )
     */
    private $date_debut;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Expression(
     *     "this.getDateDebut() < this.getDateFin()",
     *     message="La date d'arrive ne doit pas être antérieure à la date début"
     * )
     */
    private $date_fin;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="locations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }
    public function getdate_Debut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }
    public function getdate_Fin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getVoiture(): ?voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
