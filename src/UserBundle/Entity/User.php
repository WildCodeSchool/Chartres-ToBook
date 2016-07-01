<?php
// src/UserBundle/Entity/User.php

namespace UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_prenom", type="string", nullable=true, length=128)
     */
    private $userPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_prof", type="integer")
     */
    private $userProf;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set userPrenom
     *
     * @param string $userPrenom
     * @return User
     */
    public function setUserPrenom($userPrenom)
    {
        $this->userPrenom = $userPrenom;

        return $this;
    }

    /**
     * Get userPrenom
     *
     * @return string 
     */
    public function getUserPrenom()
    {
        return $this->userPrenom;
    }

    /**
     * Set userProf
     *
     * @param integer $userProf
     * @return User
     */
    public function setUserProf($userProf)
    {
        $this->userProf = $userProf;

        return $this;
    }

    /**
     * Get userProf
     *
     * @return integer 
     */
    public function getUserProf()
    {
        return $this->userProf;
    }
}
