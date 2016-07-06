<?php

namespace WCS\PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfCate
 *
 * @ORM\Table(name="prof_cate", uniqueConstraints={@ORM\UniqueConstraint(name="prca_prof_unic", columns={"prca_prof_id", "prca_cate_id"})})
 * @ORM\Entity
 */
class ProfCate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prca_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prcaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="prca_prof_id", type="bigint", nullable=false)
     */
    private $prcaProfId;

    /**
     * @var integer
     *
     * @ORM\Column(name="prca_cate_id", type="bigint", nullable=false)
     */
    private $prcaCateId;



    /**
     * Get prcaId
     *
     * @return integer 
     */
    public function getPrcaId()
    {
        return $this->prcaId;
    }

    /**
     * Set prcaProfId
     *
     * @param integer $prcaProfId
     * @return ProfCate
     */
    public function setPrcaProfId($prcaProfId)
    {
        $this->prcaProfId = $prcaProfId;

        return $this;
    }

    /**
     * Get prcaProfId
     *
     * @return integer 
     */
    public function getPrcaProfId()
    {
        return $this->prcaProfId;
    }

    /**
     * Set prcaCateId
     *
     * @param integer $prcaCateId
     * @return ProfCate
     */
    public function setPrcaCateId($prcaCateId)
    {
        $this->prcaCateId = $prcaCateId;

        return $this;
    }

    /**
     * Get prcaCateId
     *
     * @return integer 
     */
    public function getPrcaCateId()
    {
        return $this->prcaCateId;
    }
}
