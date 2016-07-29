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
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="emai_prof_id", referencedColumnName="id")
     */
    private $emaiProfId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="emai_user_id", referencedColumnName="id")
     */
    private $emaiUserId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="emai_email", type="string", length=255)
     */
    private $emaiEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_nom", type="string", length=255)
     */
    private $emaiNom;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_prenom", type="string", length=255)
     */
    private $emaiPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_adresse", type="string", length=255)
     */
    private $emaiAdresse;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_ville", type="string", length=255)
     */
    private $emaiVille;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_pays", type="string", length=255)
     */
    private $emaiPays;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_genre", type="string", length=255)
     */
    private $emaiGenre;

    /**
     * @var string
     *
     * @ORM\Column(name="emai_csp", type="string", length=255)
     */
    private $emaiCSP;

    /**
     * @var date
     *
     * @ORM\Column(name="emai_date_upload", type="date")
     */
    private $emaiDateUpload;
    
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Merci de choisir un fichier csv.")
     * @Assert\File(mimeTypes={ "text/plain" })
     */
    private $emaiCSVFile;

    public function getEmaiCSVFile()
    {
        return $this->emaiCSVFile;
    }

    public function setEmaiCSVFile($emaiCSVFile)
    {
        $this->emaiCSVFile = $emaiCSVFile;

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
     * Set emaiEmail
     *
     * @param string $emaiEmail
     * @return EmailUserListing
     */
    public function setEmaiEmail($emaiEmail)
    {
        $this->emaiEmail = $emaiEmail;

        return $this;
    }

    /**
     * Get emaiEmail
     *
     * @return string 
     */
    public function getEmaiEmail()
    {
        return $this->emaiEmail;
    }

    /**
     * Set emaiNom
     *
     * @param string $emaiNom
     * @return EmailUserListing
     */
    public function setEmaiNom($emaiNom)
    {
        $this->emaiNom = $emaiNom;

        return $this;
    }

    /**
     * Get emaiNom
     *
     * @return string 
     */
    public function getEmaiNom()
    {
        return $this->emaiNom;
    }

    /**
     * Set emaiPrenom
     *
     * @param string $emaiPrenom
     * @return EmailUserListing
     */
    public function setEmaiPrenom($emaiPrenom)
    {
        $this->emaiPrenom = $emaiPrenom;

        return $this;
    }

    /**
     * Get emaiPrenom
     *
     * @return string 
     */
    public function getEmaiPrenom()
    {
        return $this->emaiPrenom;
    }

    /**
     * Set emaiAdresse
     *
     * @param string $emaiAdresse
     * @return EmailUserListing
     */
    public function setEmaiAdresse($emaiAdresse)
    {
        $this->emaiAdresse = $emaiAdresse;

        return $this;
    }

    /**
     * Get emaiAdresse
     *
     * @return string 
     */
    public function getEmaiAdresse()
    {
        return $this->emaiAdresse;
    }

    /**
     * Set emaiVille
     *
     * @param string $emaiVille
     * @return EmailUserListing
     */
    public function setEmaiVille($emaiVille)
    {
        $this->emaiVille = $emaiVille;

        return $this;
    }

    /**
     * Get emaiVille
     *
     * @return string 
     */
    public function getEmaiVille()
    {
        return $this->emaiVille;
    }

    /**
     * Set emaiPays
     *
     * @param string $emaiPays
     * @return EmailUserListing
     */
    public function setEmaiPays($emaiPays)
    {
        $this->emaiPays = $emaiPays;

        return $this;
    }

    /**
     * Get emaiPays
     *
     * @return string 
     */
    public function getEmaiPays()
    {
        return $this->emaiPays;
    }

    /**
     * Set emaiGenre
     *
     * @param string $emaiGenre
     * @return EmailUserListing
     */
    public function setEmaiGenre($emaiGenre)
    {
        $this->emaiGenre = $emaiGenre;

        return $this;
    }

    /**
     * Get emaiGenre
     *
     * @return string 
     */
    public function getEmaiGenre()
    {
        return $this->emaiGenre;
    }

    /**
     * Set emaiCSP
     *
     * @param string $emaiCSP
     * @return EmailUserListing
     */
    public function setEmaiCSP($emaiCSP)
    {
        $this->emaiCSP = $emaiCSP;

        return $this;
    }

    /**
     * Get emaiCSP
     *
     * @return string 
     */
    public function getEmaiCSP()
    {
        return $this->emaiCSP;
    }

    /**
     * Set emaiDateUpload
     *
     * @param \DateTime $emaiDateUpload
     * @return EmailUserListing
     */
    public function setEmaiDateUpload($emaiDateUpload)
    {
        $this->emaiDateUpload = $emaiDateUpload;

        return $this;
    }

    /**
     * Get emaiDateUpload
     *
     * @return \DateTime 
     */
    public function getEmaiDateUpload()
    {
        return $this->emaiDateUpload;
    }

    /**
     * Set emaiProfId
     *
     * @param \WCS\PropertyBundle\Entity\Professionnel $emaiProfId
     * @return EmailUserListing
     */
    public function setEmaiProfId(\WCS\PropertyBundle\Entity\Professionnel $emaiProfId = null)
    {
        $this->emaiProfId = $emaiProfId;

        return $this;
    }

    /**
     * Get emaiProfId
     *
     * @return \WCS\PropertyBundle\Entity\Professionnel 
     */
    public function getEmaiProfId()
    {
        return $this->emaiProfId;
    }

    /**
     * Set emaiUserId
     *
     * @param \UserBundle\Entity\User $emaiUserId
     * @return EmailUserListing
     */
    public function setEmaiUserId(\UserBundle\Entity\User $emaiUserId = null)
    {
        $this->emaiUserId = $emaiUserId;

        return $this;
    }

    /**
     * Get emaiUserId
     *
     * @return \UserBundle\Entity\User 
     */
    public function getEmaiUserId()
    {
        return $this->emaiUserId;
    }
}
