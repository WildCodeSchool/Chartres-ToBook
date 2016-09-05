<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserListe
 *
 * @ORM\Table(name="user_liste", uniqueConstraints={@ORM\UniqueConstraint(name="usli_unic", columns={"usli_user_id", "usli_prof_id"})})
 * @ORM\Entity
 */
class UserListe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="usli_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $usliId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="usli_user_id", referencedColumnName="id")
     */
    private $usliUserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="usli_prof_id", type="bigint", nullable=false)
     */
    private $usliProfId;



    /**
     * Get usliId
     *
     * @return integer 
     */
    public function getUsliId()
    {
        return $this->usliId;
    }

    /**
     * Set usliUserId
     *
     * @param integer $usliUserId
     * @return UserListe
     */
    public function setUsliUserId($usliUserId)
    {
        $this->usliUserId = $usliUserId;

        return $this;
    }

    /**
     * Get usliUserId
     *
     * @return integer 
     */
    public function getUsliUserId()
    {
        return $this->usliUserId;
    }

    /**
     * Set usliProfId
     *
     * @param integer $usliProfId
     * @return UserListe
     */
    public function setUsliProfId($usliProfId)
    {
        $this->usliProfId = $usliProfId;

        return $this;
    }

    /**
     * Get usliProfId
     *
     * @return integer 
     */
    public function getUsliProfId()
    {
        return $this->usliProfId;
    }
}
