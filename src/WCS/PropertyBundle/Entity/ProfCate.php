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
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel", inversedBy="profCateId")
     * @ORM\JoinColumn(name="prca_prof_id", referencedColumnName="id")
     */
    private $prcaProfId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Categorie")
     * @ORM\JoinColumn(name="prca_cate_id", referencedColumnName="cate_id")
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
     * @param \WCS\PropertyBundle\Entity\Professionnel $prcaProfId
     * @return ProfCate
     */
    public function setPrcaProfId(\WCS\PropertyBundle\Entity\Professionnel $prcaProfId = null)
    {
        $this->prcaProfId = $prcaProfId;

        return $this;
    }

    /**
     * Get prcaProfId
     *
     * @return \WCS\PropertyBundle\Entity\Professionnel 
     */
    public function getPrcaProfId()
    {
        return $this->prcaProfId;
    }

    /**
     * Set prcaCateId
     *
     * @param \WCS\PropertyBundle\Entity\Categorie $prcaCateId
     * @return ProfCate
     */
    public function setPrcaCateId(\WCS\PropertyBundle\Entity\Categorie $prcaCateId = null)
    {
        $this->prcaCateId = $prcaCateId;

        return $this;
    }

    /**
     * Get prcaCateId
     *
     * @return \WCS\PropertyBundle\Entity\Categorie 
     */
    public function getPrcaCateId()
    {
        return $this->prcaCateId;
    }
}
