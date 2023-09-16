<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typePension;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $darrive;



    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dquitte;


    /**
     * @ORM\Column(type="float")
     */
    private $prixTotal;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="reservation", orphanRemoval=true)
     */
    private $chambre;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Reservation
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTypePension()
    {
        return $this->typePension;
    }

    /**
     * @param mixed $typePension
     * @return Reservation
     */
    public function setTypePension($typePension)
    {
        $this->typePension = $typePension;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDarrive()
    {
        return $this->darrive;
    }

    /**
     * @param mixed $darrive
     * @return Reservation
     */
    public function setDarrive($darrive)
    {
        $this->darrive = $darrive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDquitte()
    {
        return $this->dquitte;
    }

    /**
     * @param mixed $dquitte
     * @return Reservation
     */
    public function setDquitte($dquitte)
    {
        $this->dquitte = $dquitte;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * @param mixed $prixTotal
     * @return Reservation
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;
        return $this;
    }

    /**
     * @return Collection<int, Chambre>
     */
    public function getChambre(): Collection
    {
        return $this->chambre;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambre->contains($chambre)) {
            $this->chambre[] = $chambre;
            $chambre->setReservation($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getReservation() === $this) {
                $chambre->setReservation(null);
            }
        }

        return $this;
    }




}
