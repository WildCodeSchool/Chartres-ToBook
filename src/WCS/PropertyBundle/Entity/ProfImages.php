<?php

namespace PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfImages
 *
 * @ORM\Table(name="prof_images")
 * @ORM\Entity
 */
class ProfImages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prim_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $primId;

    /**
     * @var integer
     *
     * @ORM\Column(name="prim_prof_id", type="bigint", nullable=false)
     */
    private $primProfId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prim_defaut", type="boolean", nullable=false)
     */
    private $primDefaut;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prim_ord", type="boolean", nullable=false)
     */
    private $primOrd;

    /**
     * @var string
     *
     * @ORM\Column(name="prim_ext", type="string", length=16, nullable=false)
     */
    private $primExt;

    /**
     * @var string
     *
     * @ORM\Column(name="prim_nom", type="string", length=250, nullable=true)
     */
    private $primNom;

    /**
     * @var string
     *
     * @ORM\Column(name="prim_xy", type="decimal", precision=6, scale=3, nullable=true)
     */
    private $primXy;

    /**
     * @var string
     *
     * @ORM\Column(name="prim_img_url", type="text", length=65535, nullable=true)
     */
    private $primImgUrl;



    /**
     * Get primId
     *
     * @return integer 
     */
    public function getPrimId()
    {
        return $this->primId;
    }

    /**
     * Set primProfId
     *
     * @param integer $primProfId
     * @return ProfImages
     */
    public function setPrimProfId($primProfId)
    {
        $this->primProfId = $primProfId;

        return $this;
    }

    /**
     * Get primProfId
     *
     * @return integer 
     */
    public function getPrimProfId()
    {
        return $this->primProfId;
    }

    /**
     * Set primDefaut
     *
     * @param boolean $primDefaut
     * @return ProfImages
     */
    public function setPrimDefaut($primDefaut)
    {
        $this->primDefaut = $primDefaut;

        return $this;
    }

    /**
     * Get primDefaut
     *
     * @return boolean 
     */
    public function getPrimDefaut()
    {
        return $this->primDefaut;
    }

    /**
     * Set primOrd
     *
     * @param boolean $primOrd
     * @return ProfImages
     */
    public function setPrimOrd($primOrd)
    {
        $this->primOrd = $primOrd;

        return $this;
    }

    /**
     * Get primOrd
     *
     * @return boolean 
     */
    public function getPrimOrd()
    {
        return $this->primOrd;
    }

    /**
     * Set primExt
     *
     * @param string $primExt
     * @return ProfImages
     */
    public function setPrimExt($primExt)
    {
        $this->primExt = $primExt;

        return $this;
    }

    /**
     * Get primExt
     *
     * @return string 
     */
    public function getPrimExt()
    {
        return $this->primExt;
    }

    /**
     * Set primNom
     *
     * @param string $primNom
     * @return ProfImages
     */
    public function setPrimNom($primNom)
    {
        $this->primNom = $primNom;

        return $this;
    }

    /**
     * Get primNom
     *
     * @return string 
     */
    public function getPrimNom()
    {
        return $this->primNom;
    }

    /**
     * Set primXy
     *
     * @param string $primXy
     * @return ProfImages
     */
    public function setPrimXy($primXy)
    {
        $this->primXy = $primXy;

        return $this;
    }

    /**
     * Get primXy
     *
     * @return string 
     */
    public function getPrimXy()
    {
        return $this->primXy;
    }

    /**
     * Set primImgUrl
     *
     * @param string $primImgUrl
     * @return ProfImages
     */
    public function setPrimImgUrl($primImgUrl)
    {
        $this->primImgUrl = $primImgUrl;

        return $this;
    }

    /**
     * Get primImgUrl
     *
     * @return string 
     */
    public function getPrimImgUrl()
    {
        return $this->primImgUrl;
    }
}
