<?php

namespace WCS\ContentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contenu
 *
 * @ORM\Table(name="contenu")
 * @ORM\Entity
 */
class Contenu
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cont_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $contId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_cont_id", type="bigint", nullable=true)
     */
    private $contContId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_source_id", type="integer", nullable=true)
     */
    private $contSourceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_user_id", type="bigint", nullable=false)
     */
    private $contUserId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_prof_id", type="integer", nullable=false)
     */
    private $contProfId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cont_cible_id", type="integer", nullable=true)
     */
    private $contCibleId;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_source_type", type="string", length=4, nullable=true)
     */
    private $contSourceType;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_cible_type", type="string", length=4, nullable=true)
     */
    private $contCibleType;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_droits", type="string", length=8, nullable=true)
     */
    private $contDroits;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_actif", type="boolean", nullable=true)
     */
    private $contActif;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_visible", type="boolean", nullable=true)
     */
    private $contVisible;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_nature", type="string", length=8, nullable=true)
     */
    private $contNature;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="cont_date", type="datetime", nullable=true)
     */
    private $contDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_note_1", type="boolean", nullable=true)
     */
    private $contNote1;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_note_2", type="boolean", nullable=true)
     */
    private $contNote2;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_note_3", type="boolean", nullable=true)
     */
    private $contNote3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cont_note_4", type="boolean", nullable=true)
     */
    private $contNote4;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_sujet", type="string", length=250, nullable=true)
     */
    private $contSujet;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_text", type="text", length=65535, nullable=true)
     */
    private $contText;

    /**
     * @ORM\Column(type="string", nullable=true)
     *
     * @Assert\File(mimeTypes={ "image/gif", "image/jpeg", "image/pjpeg", "image/png" })
     */
    private $contImgExt;

    /**
     * @var string
     *
     * @ORM\Column(name="cont_img_xy", type="decimal", precision=6, scale=3, nullable=true)
     */
    private $contImgXy;



    /**
     * Get contId
     *
     * @return integer 
     */
    public function getContId()
    {
        return $this->contId;
    }

    /**
     * Set contContId
     *
     * @param integer $contContId
     * @return Contenu
     */
    public function setContContId($contContId)
    {
        $this->contContId = $contContId;

        return $this;
    }

    /**
     * Get contContId
     *
     * @return integer 
     */
    public function getContContId()
    {
        return $this->contContId;
    }

    /**
     * Set contSourceId
     *
     * @param integer $contSourceId
     * @return Contenu
     */
    public function setContSourceId($contSourceId)
    {
        $this->contSourceId = $contSourceId;

        return $this;
    }

    /**
     * Get contSourceId
     *
     * @return integer 
     */
    public function getContSourceId()
    {
        return $this->contSourceId;
    }

    /**
     * Set contCibleId
     *
     * @param integer $contCibleId
     * @return Contenu
     */
    public function setContCibleId($contCibleId)
    {
        $this->contCibleId = $contCibleId;

        return $this;
    }

    /**
     * Get contCibleId
     *
     * @return integer 
     */
    public function getContCibleId()
    {
        return $this->contCibleId;
    }

    /**
     * Set contSourceType
     *
     * @param string $contSourceType
     * @return Contenu
     */
    public function setContSourceType($contSourceType)
    {
        $this->contSourceType = $contSourceType;

        return $this;
    }

    /**
     * Get contSourceType
     *
     * @return string 
     */
    public function getContSourceType()
    {
        return $this->contSourceType;
    }

    /**
     * Set contCibleType
     *
     * @param string $contCibleType
     * @return Contenu
     */
    public function setContCibleType($contCibleType)
    {
        $this->contCibleType = $contCibleType;

        return $this;
    }

    /**
     * Get contCibleType
     *
     * @return string 
     */
    public function getContCibleType()
    {
        return $this->contCibleType;
    }

    /**
     * Set contDroits
     *
     * @param string $contDroits
     * @return Contenu
     */
    public function setContDroits($contDroits)
    {
        $this->contDroits = $contDroits;

        return $this;
    }

    /**
     * Get contDroits
     *
     * @return string 
     */
    public function getContDroits()
    {
        return $this->contDroits;
    }

    /**
     * Set contActif
     *
     * @param boolean $contActif
     * @return Contenu
     */
    public function setContActif($contActif)
    {
        $this->contActif = $contActif;

        return $this;
    }

    /**
     * Get contActif
     *
     * @return boolean 
     */
    public function getContActif()
    {
        return $this->contActif;
    }

    /**
     * Set contVisible
     *
     * @param boolean $contVisible
     * @return Contenu
     */
    public function setContVisible($contVisible)
    {
        $this->contVisible = $contVisible;

        return $this;
    }

    /**
     * Get contVisible
     *
     * @return boolean 
     */
    public function getContVisible()
    {
        return $this->contVisible;
    }

    /**
     * Set contNature
     *
     * @param string $contNature
     * @return Contenu
     */
    public function setContNature($contNature)
    {
        $this->contNature = $contNature;

        return $this;
    }

    /**
     * Get contNature
     *
     * @return string 
     */
    public function getContNature()
    {
        return $this->contNature;
    }

    /**
     * Set contDate
     *
     * @param \DateTime $contDate
     * @return Contenu
     */
    public function setContDate($contDate)
    {
        $this->contDate = $contDate;

        return $this;
    }

    /**
     * Get contDate
     *
     * @return \DateTime 
     */
    public function getContDate()
    {
        return $this->contDate;
    }

    /**
     * Set contNote1
     *
     * @param boolean $contNote1
     * @return Contenu
     */
    public function setContNote1($contNote1)
    {
        $this->contNote1 = $contNote1;

        return $this;
    }

    /**
     * Get contNote1
     *
     * @return boolean 
     */
    public function getContNote1()
    {
        return $this->contNote1;
    }

    /**
     * Set contNote2
     *
     * @param boolean $contNote2
     * @return Contenu
     */
    public function setContNote2($contNote2)
    {
        $this->contNote2 = $contNote2;

        return $this;
    }

    /**
     * Get contNote2
     *
     * @return boolean 
     */
    public function getContNote2()
    {
        return $this->contNote2;
    }

    /**
     * Set contNote3
     *
     * @param boolean $contNote3
     * @return Contenu
     */
    public function setContNote3($contNote3)
    {
        $this->contNote3 = $contNote3;

        return $this;
    }

    /**
     * Get contNote3
     *
     * @return boolean 
     */
    public function getContNote3()
    {
        return $this->contNote3;
    }

    /**
     * Set contNote4
     *
     * @param boolean $contNote4
     * @return Contenu
     */
    public function setContNote4($contNote4)
    {
        $this->contNote4 = $contNote4;

        return $this;
    }

    /**
     * Get contNote4
     *
     * @return boolean 
     */
    public function getContNote4()
    {
        return $this->contNote4;
    }

    /**
     * Set contImgExt
     *
     * @param string $contImgExt
     * @return Contenu
     */
    public function setContImgExt($contImgExt)
    {
        $this->contImgExt = $contImgExt;

        return $this;
    }

    /**
     * Get contImgExt
     *
     * @return string 
     */
    public function getContImgExt()
    {
        return $this->contImgExt;
    }

    /**
     * Set contImgXy
     *
     * @param string $contImgXy
     * @return Contenu
     */
    public function setContImgXy($contImgXy)
    {
        $this->contImgXy = $contImgXy;

        return $this;
    }

    /**
     * Get contImgXy
     *
     * @return string 
     */
    public function getContImgXy()
    {
        return $this->contImgXy;
    }

    /**
     * Set contSujet
     *
     * @param string $contSujet
     * @return Contenu
     */
    public function setContSujet($contSujet)
    {
        $this->contSujet = $contSujet;

        return $this;
    }

    /**
     * Get contSujet
     *
     * @return string 
     */
    public function getContSujet()
    {
        return $this->contSujet;
    }

    /**
     * Set contText
     *
     * @param string $contText
     * @return Contenu
     */
    public function setContText($contText)
    {
        $this->contText = $contText;

        return $this;
    }

    /**
     * Get contText
     *
     * @return string 
     */
    public function getContText()
    {
        return $this->contText;
    }

    /**
     * Set contUserId
     *
     * @param integer $contUserId
     * @return Contenu
     */
    public function setContUserId($contUserId)
    {
        $this->contUserId = $contUserId;

        return $this;
    }

    /**
     * Get contUserId
     *
     * @return integer 
     */
    public function getContUserId()
    {
        return $this->contUserId;
    }

    /**
     * Set contProfId
     *
     * @param integer $contProfId
     * @return Contenu
     */
    public function setContProfId($contProfId)
    {
        $this->contProfId = $contProfId;

        return $this;
    }

    /**
     * Get contProfId
     *
     * @return integer 
     */
    public function getContProfId()
    {
        return $this->contProfId;
    }
}
