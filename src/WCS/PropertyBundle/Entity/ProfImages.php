<?php

namespace WCS\PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel", inversedBy="profimages")
     * @ORM\JoinColumn(name="prim_prof_id", referencedColumnName="id")
     */
    private $primProfId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="prim_defaut", type="boolean", nullable=false)
     */
    private $primDefaut;

    /**
     * @var integer
     *
     * @ORM\Column(name="prim_ord", type="integer", nullable=false)
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
     * @ORM\Column(type="string", name="prim_img_url", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/jpeg", "image/pjpeg", "image/png" })
     */
    private $primImgUrl;


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
     * @param integer $primOrd
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
     * @return integer 
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

    /**
     * Set primProfId
     *
     * @param \WCS\PropertyBundle\Entity\Professionnel $primProfId
     * @return ProfImages
     */
    public function setPrimProfId(\WCS\PropertyBundle\Entity\Professionnel $primProfId = null)
    {
        $this->primProfId = $primProfId;

        return $this;
    }

    /**
     * Get primProfId
     *
     * @return \WCS\PropertyBundle\Entity\Professionnel 
     */
    public function getPrimProfId()
    {
        return $this->primProfId;
    }
}
