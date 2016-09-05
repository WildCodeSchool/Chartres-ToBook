<?php

namespace WCS\PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity
 */
class Categorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cate_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cateId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cate_actif", type="boolean", nullable=false)
     */
    private $cateActif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cate_defaut", type="boolean", nullable=false)
     */
    private $cateDefaut;

    /**
     * @var integer
     *
     * @ORM\Column(name="cate_ord", type="bigint", nullable=false)
     */
    private $cateOrd;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_code", type="string", length=128, nullable=true)
     */
    private $cateCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cate_aff_etoile", type="boolean", nullable=false)
     */
    private $cateAffEtoile;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_nom", type="string", length=128, nullable=true)
     */
    private $cateNom;

    /**
     * @var string
     *
     * @ORM\Column(name="cate_desc", type="text", length=65535, nullable=true)
     */
    private $cateDesc;



    /**
     * Get cateId
     *
     * @return integer 
     */
    public function getCateId()
    {
        return $this->cateId;
    }

    /**
     * Set cateActif
     *
     * @param boolean $cateActif
     * @return Categorie
     */
    public function setCateActif($cateActif)
    {
        $this->cateActif = $cateActif;

        return $this;
    }

    /**
     * Get cateActif
     *
     * @return boolean 
     */
    public function getCateActif()
    {
        return $this->cateActif;
    }

    /**
     * Set cateDefaut
     *
     * @param boolean $cateDefaut
     * @return Categorie
     */
    public function setCateDefaut($cateDefaut)
    {
        $this->cateDefaut = $cateDefaut;

        return $this;
    }

    /**
     * Get cateDefaut
     *
     * @return boolean 
     */
    public function getCateDefaut()
    {
        return $this->cateDefaut;
    }

    /**
     * Set cateOrd
     *
     * @param integer $cateOrd
     * @return Categorie
     */
    public function setCateOrd($cateOrd)
    {
        $this->cateOrd = $cateOrd;

        return $this;
    }

    /**
     * Get cateOrd
     *
     * @return integer 
     */
    public function getCateOrd()
    {
        return $this->cateOrd;
    }

    /**
     * Set cateCode
     *
     * @param string $cateCode
     * @return Categorie
     */
    public function setCateCode($cateCode)
    {
        $this->cateCode = $cateCode;

        return $this;
    }

    /**
     * Get cateCode
     *
     * @return string 
     */
    public function getCateCode()
    {
        return $this->cateCode;
    }

    /**
     * Set cateAffEtoile
     *
     * @param boolean $cateAffEtoile
     * @return Categorie
     */
    public function setCateAffEtoile($cateAffEtoile)
    {
        $this->cateAffEtoile = $cateAffEtoile;

        return $this;
    }

    /**
     * Get cateAffEtoile
     *
     * @return boolean 
     */
    public function getCateAffEtoile()
    {
        return $this->cateAffEtoile;
    }

    /**
     * Set cateNom
     *
     * @param string $cateNom
     * @return Categorie
     */
    public function setCateNom($cateNom)
    {
        $this->cateNom = $cateNom;

        return $this;
    }

    /**
     * Get cateNom
     *
     * @return string 
     */
    public function getCateNom()
    {
        return $this->cateNom;
    }

    /**
     * Set cateDesc
     *
     * @param string $cateDesc
     * @return Categorie
     */
    public function setCateDesc($cateDesc)
    {
        $this->cateDesc = $cateDesc;

        return $this;
    }

    /**
     * Get cateDesc
     *
     * @return string 
     */
    public function getCateDesc()
    {
        return $this->cateDesc;
    }
}
