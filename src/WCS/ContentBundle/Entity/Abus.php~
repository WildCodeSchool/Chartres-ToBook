<?php

namespace WCS\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abus
 *
 * @ORM\Table(name="abus")
 * @ORM\Entity
 */
class Abus
{
    /**
     * @var integer
     *
     * @ORM\Column(name="abus_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $abusId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="prim_prof_id", referencedColumnName="prof_id")
     */
    private $abusUserId;

    /**
     * @var integer
     *
     * @ORM\OneToOne(targetEntity="WCS\ContentBundle\Entity\Abus")
     * @ORM\JoinColumn(name="abus_cont_id", referencedColumnName="abus_id")     
     */
    private $abusContId;



    /**
     * Get abusId
     *
     * @return integer 
     */
    public function getAbusId()
    {
        return $this->abusId;
    }

    /**
     * Set abusUserId
     *
     * @param integer $abusUserId
     * @return Abus
     */
    public function setAbusUserId($abusUserId)
    {
        $this->abusUserId = $abusUserId;

        return $this;
    }

    /**
     * Get abusUserId
     *
     * @return integer 
     */
    public function getAbusUserId()
    {
        return $this->abusUserId;
    }

    /**
     * Set abusContId
     *
     * @param integer $abusContId
     * @return Abus
     */
    public function setAbusContId($abusContId)
    {
        $this->abusContId = $abusContId;

        return $this;
    }

    /**
     * Get abusContId
     *
     * @return integer 
     */
    public function getAbusContId()
    {
        return $this->abusContId;
    }
}
