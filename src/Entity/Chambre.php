<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\Column(type="integer")
     */
    private $numChambre;

    /**
     * @ORM\Column(type="integer")
     */
    private $numEtage;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeNbBLit;



    /**
     * @ORM\Column(type="float")
     */
    private $prixParNuit;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="chambre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Hotel::class, inversedBy="chambre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hotel;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Chambre
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumChambre()
    {
        return $this->numChambre;
    }

    /**
     * @param mixed $numChambre
     * @return Chambre
     */
    public function setNumChambre($numChambre)
    {
        $this->numChambre = $numChambre;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNumEtage()
    {
        return $this->numEtage;
    }

    /**
     * @param mixed $numEtage
     * @return Chambre
     */
    public function setNumEtage($numEtage)
    {
        $this->numEtage = $numEtage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypeNbBLit()
    {
        return $this->typeNbBLit;
    }

    /**
     * @param mixed $typeNbBLit
     * @return Chambre
     */
    public function setTypeNbBLit($typeNbBLit)
    {
        $this->typeNbBLit = $typeNbBLit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrixParNuit()
    {
        return $this->prixParNuit;
    }

    /**
     * @param mixed $prixParNuit
     * @return Chambre
     */
    public function setPrixParNuit($prixParNuit)
    {
        $this->prixParNuit = $prixParNuit;
        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getHotel(): ?Hotel
    {
        return $this->hotel;
    }

    public function setHotel(?Hotel $hotel): self
    {
        $this->hotel = $hotel;

        return $this;
    }




}
