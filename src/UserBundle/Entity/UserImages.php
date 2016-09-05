<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserImages
 *
 * @ORM\Table(name="user_images")
 * @ORM\Entity
 */
class UserImages
{
    /**
     * @var integer
     *
     * @ORM\Column(name="usim_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usimId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="usim_user_id", referencedColumnName="id")
     */
    private $usimUserId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="usim_defaut", type="boolean", nullable=false)
     */
    private $usimDefaut;

    /**
     * @var integer
     *
     * @ORM\Column(name="usim_ord", type="bigint", nullable=false)
     */
    private $usimOrd;

    /**
     * @var string
     *
     * @ORM\Column(name="usim_ext", type="string", length=16, nullable=false)
     */
    private $usimExt;

    /**
     * @var string
     *
     * @ORM\Column(name="usim_nom", type="string", length=250, nullable=true)
     */
    private $usimNom;

    /**
     * @var string
     *
     * @ORM\Column(name="usim_xy", type="decimal", precision=6, scale=3, nullable=true)
     */
    private $usimXy;



    /**
     * Get usimId
     *
     * @return integer 
     */
    public function getUsimId()
    {
        return $this->usimId;
    }

    /**
     * Set usimUserId
     *
     * @param integer $usimUserId
     * @return UserImages
     */
    public function setUsimUserId($usimUserId)
    {
        $this->usimUserId = $usimUserId;

        return $this;
    }

    /**
     * Get usimUserId
     *
     * @return integer 
     */
    public function getUsimUserId()
    {
        return $this->usimUserId;
    }

    /**
     * Set usimDefaut
     *
     * @param boolean $usimDefaut
     * @return UserImages
     */
    public function setUsimDefaut($usimDefaut)
    {
        $this->usimDefaut = $usimDefaut;

        return $this;
    }

    /**
     * Get usimDefaut
     *
     * @return boolean 
     */
    public function getUsimDefaut()
    {
        return $this->usimDefaut;
    }

    /**
     * Set usimOrd
     *
     * @param integer $usimOrd
     * @return UserImages
     */
    public function setUsimOrd($usimOrd)
    {
        $this->usimOrd = $usimOrd;

        return $this;
    }

    /**
     * Get usimOrd
     *
     * @return integer 
     */
    public function getUsimOrd()
    {
        return $this->usimOrd;
    }

    /**
     * Set usimExt
     *
     * @param string $usimExt
     * @return UserImages
     */
    public function setUsimExt($usimExt)
    {
        $this->usimExt = $usimExt;

        return $this;
    }

    /**
     * Get usimExt
     *
     * @return string 
     */
    public function getUsimExt()
    {
        return $this->usimExt;
    }

    /**
     * Set usimNom
     *
     * @param string $usimNom
     * @return UserImages
     */
    public function setUsimNom($usimNom)
    {
        $this->usimNom = $usimNom;

        return $this;
    }

    /**
     * Get usimNom
     *
     * @return string 
     */
    public function getUsimNom()
    {
        return $this->usimNom;
    }

    /**
     * Set usimXy
     *
     * @param string $usimXy
     * @return UserImages
     */
    public function setUsimXy($usimXy)
    {
        $this->usimXy = $usimXy;

        return $this;
    }

    /**
     * Get usimXy
     *
     * @return string 
     */
    public function getUsimXy()
    {
        return $this->usimXy;
    }
}
