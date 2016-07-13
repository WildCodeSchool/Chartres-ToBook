<?php

namespace WCS\EmailingBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmailUserListing
 *
 * @ORM\Table(name="email_user_listing")
 * @ORM\Entity(repositoryClass="WCS\EmailingBundle\Repository\EmailUserListingRepository")
 */
class EmailUserListing
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="addresse", type="string", length=255)
     */
    private $addresse;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="csp", type="string", length=255)
     */
    private $csp;

    /**
     * @var date
     *
     * @ORM\Column(name="date_upload", type="date")
     */
    private $dateUpload;
    
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Merci de choisir un fichier csv.")
     * @Assert\File(mimeTypes={ "text/plain" })
     */
    private $csvFile;

    public function getCsv()
    {
        return $this->csvFile;
    }

    public function setCsv($csvFile)
    {
        $this->csvFile = $csvFile;

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return EmailUserListing
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return EmailUserListing
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return EmailUserListing
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set addresse
     *
     * @param string $addresse
     * @return EmailUserListing
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * Get addresse
     *
     * @return string 
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return EmailUserListing
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return EmailUserListing
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set genre
     *
     * @param string $genre
     * @return EmailUserListing
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string 
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set csp
     *
     * @param string $csp
     * @return EmailUserListing
     */
    public function setCsp($csp)
    {
        $this->csp = $csp;

        return $this;
    }

    /**
     * Get csp
     *
     * @return string 
     */
    public function getCsp()
    {
        return $this->csp;
    }

    /**
     * Set dateUpload
     *
     * @param \DateTime $dateUpload
     * @return EmailUserListing
     */
    public function setDateUpload($dateUpload)
    {
        $this->dateUpload = $dateUpload;

        return $this;
    }

    /**
     * Get dateUpload
     *
     * @return \DateTime 
     */
    public function getDateUpload()
    {
        return $this->dateUpload;
    }
}
