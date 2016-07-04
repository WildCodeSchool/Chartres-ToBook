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
     * @var boolean
     *
     * @ORM\Column(name="user_prof", type="boolean", nullable=false)
     */
    private $userProf;

    /**
     * @var string
     *
     * @ORM\Column(name="user_prenom", type="string", length=128, nullable=true)
     */
    private $userPrenom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_nom", type="string", length=128, nullable=true)
     */
    private $userNom;

    /**
     * @var string
     *
     * @ORM\Column(name="user_langue", type="string", length=4, nullable=true)
     */
    private $userLangue;

    /**
     * @var string
     *
     * @ORM\Column(name="user_add1", type="string", length=250, nullable=true)
     */
    private $userAdd1;

    /**
     * @var string
     *
     * @ORM\Column(name="user_add2", type="string", length=250, nullable=true)
     */
    private $userAdd2;

    /**
     * @var string
     *
     * @ORM\Column(name="user_cp", type="string", length=16, nullable=true)
     */
    private $userCp;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ville", type="string", length=250, nullable=true)
     */
    private $userVille;

    /**
     * @var string
     *
     * @ORM\Column(name="user_tel", type="string", length=32, nullable=true)
     */
    private $userTel;

    /**
     * @var string
     *
     * @ORM\Column(name="user_mob", type="string", length=32, nullable=true)
     */
    private $userMob;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_dt_nais", type="date", nullable=true)
     */
    private $userDtNais;

    /**
     * @var string
     *
     * @ORM\Column(name="user_descriptif", type="text", length=65535, nullable=true)
     */
    private $userDescriptif;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
    }

    /**
     * Set userProf
     *
     * @param boolean $userProf
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
     * @return boolean 
     */
    public function getUserProf()
    {
        return $this->userProf;
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
     * Set userLangue
     *
     * @param string $userLangue
     * @return User
     */
    public function setUserLangue($userLangue)
    {
        $this->userLangue = $userLangue;

        return $this;
    }

    /**
     * Get userLangue
     *
     * @return string 
     */
    public function getUserLangue()
    {
        return $this->userLangue;
    }

    /**
     * Set userAdd1
     *
     * @param string $userAdd1
     * @return User
     */
    public function setUserAdd1($userAdd1)
    {
        $this->userAdd1 = $userAdd1;

        return $this;
    }

    /**
     * Get userAdd1
     *
     * @return string 
     */
    public function getUserAdd1()
    {
        return $this->userAdd1;
    }

    /**
     * Set userAdd2
     *
     * @param string $userAdd2
     * @return User
     */
    public function setUserAdd2($userAdd2)
    {
        $this->userAdd2 = $userAdd2;

        return $this;
    }

    /**
     * Get userAdd2
     *
     * @return string 
     */
    public function getUserAdd2()
    {
        return $this->userAdd2;
    }

    /**
     * Set userCp
     *
     * @param string $userCp
     * @return User
     */
    public function setUserCp($userCp)
    {
        $this->userCp = $userCp;

        return $this;
    }

    /**
     * Get userCp
     *
     * @return string 
     */
    public function getUserCp()
    {
        return $this->userCp;
    }

    /**
     * Set userVille
     *
     * @param string $userVille
     * @return User
     */
    public function setUserVille($userVille)
    {
        $this->userVille = $userVille;

        return $this;
    }

    /**
     * Get userVille
     *
     * @return string 
     */
    public function getUserVille()
    {
        return $this->userVille;
    }

    /**
     * Set userTel
     *
     * @param string $userTel
     * @return User
     */
    public function setUserTel($userTel)
    {
        $this->userTel = $userTel;

        return $this;
    }

    /**
     * Get userTel
     *
     * @return string 
     */
    public function getUserTel()
    {
        return $this->userTel;
    }

    /**
     * Set userMob
     *
     * @param string $userMob
     * @return User
     */
    public function setUserMob($userMob)
    {
        $this->userMob = $userMob;

        return $this;
    }

    /**
     * Get userMob
     *
     * @return string 
     */
    public function getUserMob()
    {
        return $this->userMob;
    }

    /**
     * Set userDtNais
     *
     * @param \DateTime $userDtNais
     * @return User
     */
    public function setUserDtNais($userDtNais)
    {
        $this->userDtNais = $userDtNais;

        return $this;
    }

    /**
     * Get userDtNais
     *
     * @return \DateTime 
     */
    public function getUserDtNais()
    {
        return $this->userDtNais;
    }

    /**
     * Set userDescriptif
     *
     * @param string $userDescriptif
     * @return User
     */
    public function setUserDescriptif($userDescriptif)
    {
        $this->userDescriptif = $userDescriptif;

        return $this;
    }

    /**
     * Get userDescriptif
     *
     * @return string 
     */
    public function getUserDescriptif()
    {
        return $this->userDescriptif;
    }

    /**
     * Set userNom
     *
     * @param string $userNom
     * @return User
     */
    public function setUserNom($userNom)
    {
        $this->userNom = $userNom;

        return $this;
    }

    /**
     * Get userNom
     *
     * @return string 
     */
    public function getUserNom()
    {
        return $this->userNom;
    }
}
