<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=HotelRepository::class)
 */
class Hotel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="nom produit doit etre non vide")
     * @Assert\Length(
     *      min = 6,
     *      minMessage=" Entrer un nom au mini de 6 caracteres"
     *
     *     )
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="nom hotel doit etre non vide")
     * @Assert\Email(
     *     message = "L'e-mail n'est pas un e-mail valide"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @Assert\NotBlank(message="le nombre des etoiles doit etre non vide")
     * @Assert\Positive
     * @Assert\Range(
     *      min = 0,
     *      max = 5,
     *      notInRangeMessage = "le nbr des etoiles doit etre valid",
     *     )
     * @ORM\Column(type="integer")
     */
    private $etoile;

    /**
     * @Assert\NotBlank(message="etat de hotel doit etre non vide")
     * @Assert\Choice({"Disponible", "non Disponible"})
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @Assert\NotBlank(message="le nombre de chambres doit etre non vide")
     *@Assert\PositiveOrZero
     * @ORM\Column(type="integer")
     */
    private $nbrChambre;

    /**
     * @Assert\NotBlank(message="le nombre de chambres doit etre non vide")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255,)
     *
     */
    private $image;


    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\OneToMany(targetEntity=Chambre::class, mappedBy="hotel", orphanRemoval=true)
     */
    private $chambre;

    public function __construct()
    {
        $this->chambre = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getEtoile(): ?int
    {
        return $this->etoile;
    }

    public function setEtoile(int $etoile): self
    {
        $this->etoile = $etoile;

        return $this;
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

    public function getNbrChambre(): ?int
    {
        return $this->nbrChambre;
    }

    public function setNbrChambre(int $nbrChambre): self
    {
        $this->nbrChambre = $nbrChambre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }


    //UPLOAD IMAGE
    //GeT PUBLIC FOLDER
    public function getPublicFolder() {
        $webPath = $this->get('kernel')->getProjectDir() . '/public/uploads/hotel_image';

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





    //prend image et l ajouter dans le dossier  hotel_image
    public function upload()
    {
        if(null === $this->getFile()) {
            return;
        }

        $this->getFile()->move(
            $this->getPublicFolder(),//destination
            $this->getFile()->getClientOriginalName()//nom fichier (image)
        );

        $this->image = $this->getFile()->getClientOriginalName();//

        $this->file = null; // liberation memoire
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
            $chambre->setHotel($this);
        }

        return $this;
    }

    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambre->removeElement($chambre)) {
            // set the owning side to null (unless already changed)
            if ($chambre->getHotel() === $this) {
                $chambre->setHotel(null);
            }
        }

        return $this;
    }




}
