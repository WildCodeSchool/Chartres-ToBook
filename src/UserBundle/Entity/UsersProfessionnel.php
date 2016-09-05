<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersProfessionnel
 *
 * @ORM\Table(name="users_professionnel", uniqueConstraints={@ORM\UniqueConstraint(name="uspr_user_id", columns={"uspr_user_id", "uspr_prof_id"})})
 * @ORM\Entity
 */
class UsersProfessionnel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="uspr_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usprId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="uspr_user_id", referencedColumnName="id")
     */
    private $usprUserId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="uspr_prof_id", referencedColumnName="id")
     */
    private $usprProfId;

    /**
     * @var integer
     *
     * @ORM\Column(name="uspr_droits", type="smallint", nullable=false)
     */
    private $usprDroits;



    /**
     * Get usprId
     *
     * @return integer 
     */
    public function getUsprId()
    {
        return $this->usprId;
    }

    /**
     * Set usprUserId
     *
     * @param integer $usprUserId
     * @return UsersProfessionnel
     */
    public function setUsprUserId($usprUserId)
    {
        $this->usprUserId = $usprUserId;

        return $this;
    }

    /**
     * Get usprUserId
     *
     * @return integer 
     */
    public function getUsprUserId()
    {
        return $this->usprUserId;
    }

    /**
     * Set usprProfId
     *
     * @param integer $usprProfId
     * @return UsersProfessionnel
     */
    public function setUsprProfId($usprProfId)
    {
        $this->usprProfId = $usprProfId;

        return $this;
    }

    /**
     * Get usprProfId
     *
     * @return integer 
     */
    public function getUsprProfId()
    {
        return $this->usprProfId;
    }

    /**
     * Set usprDroits
     *
     * @param integer $usprDroits
     * @return UsersProfessionnel
     */
    public function setUsprDroits($usprDroits)
    {
        $this->usprDroits = $usprDroits;

        return $this;
    }

    /**
     * Get usprDroits
     *
     * @return integer 
     */
    public function getUsprDroits()
    {
        return $this->usprDroits;
    }
}
