<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="la Serie doit etre non vide")
     * @Assert\Length(
     *      min = 6,
     *      minMessage=" Entrer une serie au mini de 6 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $serie;

    /**
     * @Assert\NotBlank(message="la marque doit etre non vide")
     * @Assert\Length(
     *      min = 3,
     *      minMessage=" Entrer une marque au mini de 3 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $marque;

    /**
     * @Assert\NotBlank(message="le model doit etre non vide")
     * @Assert\Length(
     *      min = 2,
     *      minMessage=" Entrer un model au mini de 2 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $model;
    /**
     * @Assert\NotBlank(message="la description doit etre non vide")
     * @Assert\Length(
     *      min = 7,
     *      max = 1000,
     *      minMessage = "doit etre >=7 ",
     *      maxMessage = "doit etre <=100" )
     * @ORM\Column(type="string", length=1000)
     */
    private $description;
    /**
     * @Assert\NotBlank(message="couleur produit doit etre non vide")
     * @ORM\Column(type="string", length=255)
     */
    private $couleur;



    /**
     * @Assert\NotBlank(message="prix produit doit etre non vide")
     * @Assert\Positive
     * @Assert\Range(
     *      min = 3,
     *      max = 1000,
     *      notInRangeMessage = "le prix doit etre valid",
     *     )
     * @ORM\Column(type="float")
     */
    private $prix;


    /**
     * @ORM\Column(type="string", length=500,nullable=true)
     */
    private $image;


    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity=Location::class, mappedBy="voiture", orphanRemoval=true)
     */
    private $locations;

    public function __construct()
    {
        $this->locations = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    public function getdescription(): ?string
    {
        return $this->description;
    }

    public function setdescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getcouleur(): ?string
    {
        return $this->couleur;
    }

    public function setcouleur(string $couleur): self
    {
        $this->couleur = $couleur;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    //UPLOAD IMAGE
    //GeT PUBLIC FOLDER
    public function getPublicFolder() {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/uploads/produit_image';

        return $webPath;


    }

    /**
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile
     */
    public function setFile($file): void
    {
        $this->file = $file;
    }


    //te5o image w tzidha fi dossier produit_image
    public function upload()
    {
        if(null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->getPublicFolder(),//destinataire
            $this->getFile()->getClientOriginalName()//esem fichier (image)
        );

        $this->image = $this->getFile()->getClientOriginalName();//

        $this->file = null; // liberation memoire
    }

    /**
     * @return Collection<int, Location>
     */
    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function addLocation(Location $location): self
    {
        if (!$this->locations->contains($location)) {
            $this->locations[] = $location;
            $location->setVoiture($this);
        }

        return $this;
    }

    public function removeLocation(Location $location): self
    {
        if ($this->locations->removeElement($location)) {
            // set the owning side to null (unless already changed)
            if ($location->getVoiture() === $this) {
                $location->setVoiture(null);
            }
        }

        return $this;
    }












}
