<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VolRepository::class)
 */
class Vol
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @Assert\NotBlank(message="etat vol doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une chaine au minimum de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=40)
     */
    private $etat;

    /**
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDepart() < this.getArrive()",
     *     message="La date de depart ne doit pas être postérieure à la date d'arrive"
     * )
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $depart;

    /**
     * @Assert\Date()
     * @Assert\Expression(
     *     "this.getDepart() < this.getArrive()",
     *     message="La date d'arrive ne doit pas être antérieure à la date début"
     * )
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $arrive;

    /**
     * @Assert\NotBlank(message="duree de vol doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une chaine au minimum de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $duree;



    /**
     * @Assert\NotBlank(message="destination de vol doit etre non vide")
     * @Assert\Length(
     *      min = 5,
     *      minMessage=" Entrer une chaine au minimum de 5 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255, nullable="true")
     */
    private $destination;

    /**
     * @Assert\NotBlank(message="nombre de place d'un vol doit etre non vide")
     * @Assert\NotEqualTo(
     *     value = 0,
     *  message = "le nombre de place d'un vol ne doit pas etre égale a 0"
     * )
     * @ORM\Column(type="integer")
     */
    private $place;
















    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(?\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getArrive(): ?\DateTimeInterface
    {
        return $this->arrive;
    }

    public function setArrive(?\DateTimeInterface $arrive): self
    {
        $this->arrive = $arrive;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }



    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getPlace(): ?int
    {
        return $this->place;
    }

    public function setPlace(int $place): self
    {
        $this->place = $place;

        return $this;
    }





















}
