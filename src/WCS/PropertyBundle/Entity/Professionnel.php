<?php

namespace WCS\PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Professionnel
 *
 * @ORM\Table(name="professionnel", uniqueConstraints={@ORM\UniqueConstraint(name="prof_code", columns={"prof_code"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="WCS\PropertyBundle\Repository\ProfessionnelRepository")
 */
class Professionnel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prof_actif", type="boolean", nullable=false)
     */
    private $profActif;

    /**
     * @ORM\OneToMany(targetEntity="WCS\PropertyBundle\Entity\ProfImages", mappedBy="primProfId")
     * @ORM\JoinColumn(nullable=false)
     */
    private $profimages;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_code", type="string", length=250, nullable=true)
     */
    private $profCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_etoiles", type="smallint", nullable=false)
     */
    private $profEtoiles;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_forme_juri", type="string", length=128, nullable=true)
     */
    private $profFormeJuri;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_nom", type="string", length=128, nullable=true)
     */
    private $profNom;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_add1", type="string", length=250, nullable=true)
     */
    private $profAdd1;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_add2", type="string", length=250, nullable=true)
     */
    private $profAdd2;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_add3", type="string", length=250, nullable=true)
     */
    private $profAdd3;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_cp", type="string", length=16, nullable=true)
     */
    private $profCp;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_ville", type="string", length=250, nullable=true)
     */
    private $profVille;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_tel", type="string", length=250, nullable=true)
     */
    private $profTel;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_fax", type="string", length=32, nullable=true)
     */
    private $profFax;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_mail", type="string", length=250, nullable=true)
     */
    private $profMail;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_web", type="string", length=250, nullable=true)
     */
    private $profWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_web_resa", type="string", length=250, nullable=true)
     */
    private $profWebResa;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_prix_mini", type="decimal", precision=8, scale=2, nullable=true)
     */
    private $profPrixMini;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_descriptif", type="text", length=65535, nullable=true)
     */
    private $profDescriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_latitude", type="decimal", precision=24, scale=20, nullable=false)
     */
    private $profLatitude;

    /**
     * @var string
     *
     * @ORM\Column(name="prof_longitude", type="decimal", precision=24, scale=20, nullable=false)
     */
    private $profLongitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_capa_personne", type="integer", nullable=true)
     */
    private $profCapaPersonne;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_capa_chambre", type="integer", nullable=true)
     */
    private $profCapaChambre;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_capa_emplacement", type="integer", nullable=true)
     */
    private $profCapaEmplacement;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_capa_habitation", type="integer", nullable=true)
     */
    private $profCapaHabitation;

    /**
     * @var integer
     *
     * @ORM\Column(name="prof_temp", type="smallint", nullable=true)
     */
    private $profTemp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->profCateId = new \Doctrine\Common\Collections\ArrayCollection();
        $this->profimages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set profActif
     *
     * @param boolean $profActif
     * @return Professionnel
     */
    public function setProfActif($profActif)
    {
        $this->profActif = $profActif;

        return $this;
    }

    /**
     * Get profActif
     *
     * @return boolean 
     */
    public function getProfActif()
    {
        return $this->profActif;
    }

    /**
     * Set profCode
     *
     * @param string $profCode
     * @return Professionnel
     */
    public function setProfCode($profCode)
    {
        $this->profCode = $profCode;

        return $this;
    }

    /**
     * Get profCode
     *
     * @return string 
     */
    public function getProfCode()
    {
        return $this->profCode;
    }

    /**
     * Set profEtoiles
     *
     * @param integer $profEtoiles
     * @return Professionnel
     */
    public function setProfEtoiles($profEtoiles)
    {
        $this->profEtoiles = $profEtoiles;

        return $this;
    }

    /**
     * Get profEtoiles
     *
     * @return integer 
     */
    public function getProfEtoiles()
    {
        return $this->profEtoiles;
    }

    /**
     * Set profFormeJuri
     *
     * @param string $profFormeJuri
     * @return Professionnel
     */
    public function setProfFormeJuri($profFormeJuri)
    {
        $this->profFormeJuri = $profFormeJuri;

        return $this;
    }

    /**
     * Get profFormeJuri
     *
     * @return string 
     */
    public function getProfFormeJuri()
    {
        return $this->profFormeJuri;
    }

    /**
     * Set profNom
     *
     * @param string $profNom
     * @return Professionnel
     */
    public function setProfNom($profNom)
    {
        $this->profNom = $profNom;

        return $this;
    }

    /**
     * Get profNom
     *
     * @return string 
     */
    public function getProfNom()
    {
        return $this->profNom;
    }

    /**
     * Set profAdd1
     *
     * @param string $profAdd1
     * @return Professionnel
     */
    public function setProfAdd1($profAdd1)
    {
        $this->profAdd1 = $profAdd1;

        return $this;
    }

    /**
     * Get profAdd1
     *
     * @return string 
     */
    public function getProfAdd1()
    {
        return $this->profAdd1;
    }

    /**
     * Set profAdd2
     *
     * @param string $profAdd2
     * @return Professionnel
     */
    public function setProfAdd2($profAdd2)
    {
        $this->profAdd2 = $profAdd2;

        return $this;
    }

    /**
     * Get profAdd2
     *
     * @return string 
     */
    public function getProfAdd2()
    {
        return $this->profAdd2;
    }

    /**
     * Set profAdd3
     *
     * @param string $profAdd3
     * @return Professionnel
     */
    public function setProfAdd3($profAdd3)
    {
        $this->profAdd3 = $profAdd3;

        return $this;
    }

    /**
     * Get profAdd3
     *
     * @return string 
     */
    public function getProfAdd3()
    {
        return $this->profAdd3;
    }

    /**
     * Set profCp
     *
     * @param string $profCp
     * @return Professionnel
     */
    public function setProfCp($profCp)
    {
        $this->profCp = $profCp;

        return $this;
    }

    /**
     * Get profCp
     *
     * @return string 
     */
    public function getProfCp()
    {
        return $this->profCp;
    }

    /**
     * Set profVille
     *
     * @param string $profVille
     * @return Professionnel
     */
    public function setProfVille($profVille)
    {
        $this->profVille = $profVille;

        return $this;
    }

    /**
     * Get profVille
     *
     * @return string 
     */
    public function getProfVille()
    {
        return $this->profVille;
    }

    /**
     * Set profTel
     *
     * @param string $profTel
     * @return Professionnel
     */
    public function setProfTel($profTel)
    {
        $this->profTel = $profTel;

        return $this;
    }

    /**
     * Get profTel
     *
     * @return string 
     */
    public function getProfTel()
    {
        return $this->profTel;
    }

    /**
     * Set profFax
     *
     * @param string $profFax
     * @return Professionnel
     */
    public function setProfFax($profFax)
    {
        $this->profFax = $profFax;

        return $this;
    }

    /**
     * Get profFax
     *
     * @return string 
     */
    public function getProfFax()
    {
        return $this->profFax;
    }

    /**
     * Set profMail
     *
     * @param string $profMail
     * @return Professionnel
     */
    public function setProfMail($profMail)
    {
        $this->profMail = $profMail;

        return $this;
    }

    /**
     * Get profMail
     *
     * @return string 
     */
    public function getProfMail()
    {
        return $this->profMail;
    }

    /**
     * Set profWeb
     *
     * @param string $profWeb
     * @return Professionnel
     */
    public function setProfWeb($profWeb)
    {
        $this->profWeb = $profWeb;

        return $this;
    }

    /**
     * Get profWeb
     *
     * @return string 
     */
    public function getProfWeb()
    {
        return $this->profWeb;
    }

    /**
     * Set profWebResa
     *
     * @param string $profWebResa
     * @return Professionnel
     */
    public function setProfWebResa($profWebResa)
    {
        $this->profWebResa = $profWebResa;

        return $this;
    }

    /**
     * Get profWebResa
     *
     * @return string 
     */
    public function getProfWebResa()
    {
        return $this->profWebResa;
    }

    /**
     * Set profPrixMini
     *
     * @param string $profPrixMini
     * @return Professionnel
     */
    public function setProfPrixMini($profPrixMini)
    {
        $this->profPrixMini = $profPrixMini;

        return $this;
    }

    /**
     * Get profPrixMini
     *
     * @return string 
     */
    public function getProfPrixMini()
    {
        return $this->profPrixMini;
    }

    /**
     * Set profDescriptif
     *
     * @param string $profDescriptif
     * @return Professionnel
     */
    public function setProfDescriptif($profDescriptif)
    {
        $this->profDescriptif = $profDescriptif;

        return $this;
    }

    /**
     * Get profDescriptif
     *
     * @return string 
     */
    public function getProfDescriptif()
    {
        return $this->profDescriptif;
    }

    /**
     * Set profLatitude
     *
     * @param string $profLatitude
     * @return Professionnel
     */
    public function setProfLatitude($profLatitude)
    {
        $this->profLatitude = $profLatitude;

        return $this;
    }

    /**
     * Get profLatitude
     *
     * @return string 
     */
    public function getProfLatitude()
    {
        return $this->profLatitude;
    }

    /**
     * Set profLongitude
     *
     * @param string $profLongitude
     * @return Professionnel
     */
    public function setProfLongitude($profLongitude)
    {
        $this->profLongitude = $profLongitude;

        return $this;
    }

    /**
     * Get profLongitude
     *
     * @return string 
     */
    public function getProfLongitude()
    {
        return $this->profLongitude;
    }

    /**
     * Set profCapaPersonne
     *
     * @param integer $profCapaPersonne
     * @return Professionnel
     */
    public function setProfCapaPersonne($profCapaPersonne)
    {
        $this->profCapaPersonne = $profCapaPersonne;

        return $this;
    }

    /**
     * Get profCapaPersonne
     *
     * @return integer 
     */
    public function getProfCapaPersonne()
    {
        return $this->profCapaPersonne;
    }

    /**
     * Set profCapaChambre
     *
     * @param integer $profCapaChambre
     * @return Professionnel
     */
    public function setProfCapaChambre($profCapaChambre)
    {
        $this->profCapaChambre = $profCapaChambre;

        return $this;
    }

    /**
     * Get profCapaChambre
     *
     * @return integer 
     */
    public function getProfCapaChambre()
    {
        return $this->profCapaChambre;
    }

    /**
     * Set profCapaEmplacement
     *
     * @param integer $profCapaEmplacement
     * @return Professionnel
     */
    public function setProfCapaEmplacement($profCapaEmplacement)
    {
        $this->profCapaEmplacement = $profCapaEmplacement;

        return $this;
    }

    /**
     * Get profCapaEmplacement
     *
     * @return integer 
     */
    public function getProfCapaEmplacement()
    {
        return $this->profCapaEmplacement;
    }

    /**
     * Set profCapaHabitation
     *
     * @param integer $profCapaHabitation
     * @return Professionnel
     */
    public function setProfCapaHabitation($profCapaHabitation)
    {
        $this->profCapaHabitation = $profCapaHabitation;

        return $this;
    }

    /**
     * Get profCapaHabitation
     *
     * @return integer 
     */
    public function getProfCapaHabitation()
    {
        return $this->profCapaHabitation;
    }

    /**
     * Set profTemp
     *
     * @param integer $profTemp
     * @return Professionnel
     */
    public function setProfTemp($profTemp)
    {
        $this->profTemp = $profTemp;

        return $this;
    }

    /**
     * Get profTemp
     *
     * @return integer 
     */
    public function getProfTemp()
    {
        return $this->profTemp;
    }

    /**
     * Add profCateId
     *
     * @param \WCS\PropertyBundle\Entity\ProfCate $profCateId
     * @return Professionnel
     */
    public function addProfCateId(\WCS\PropertyBundle\Entity\ProfCate $profCateId)
    {
        $this->profCateId[] = $profCateId;

        return $this;
    }

    /**
     * Remove profCateId
     *
     * @param \WCS\PropertyBundle\Entity\ProfCate $profCateId
     */
    public function removeProfCateId(\WCS\PropertyBundle\Entity\ProfCate $profCateId)
    {
        $this->profCateId->removeElement($profCateId);
    }

    /**
     * Get profCateId
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProfCateId()
    {
        return $this->profCateId;
    }

    /**
     * Add profimages
     *
     * @param \WCS\PropertyBundle\Entity\ProfImages $profimages
     * @return Professionnel
     */
    public function addProfimage(\WCS\PropertyBundle\Entity\ProfImages $profimages)
    {
        $this->profimages[] = $profimages;

        return $this;
    }

    /**
     * Remove profimages
     *
     * @param \WCS\PropertyBundle\Entity\ProfImages $profimages
     */
    public function removeProfimage(\WCS\PropertyBundle\Entity\ProfImages $profimages)
    {
        $this->profimages->removeElement($profimages);
    }

    /**
     * Get profimages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProfimages()
    {
        return $this->profimages;
    }
}
