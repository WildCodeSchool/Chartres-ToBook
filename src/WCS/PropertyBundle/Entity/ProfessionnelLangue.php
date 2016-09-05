<?php

namespace WCS\PropertyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProfessionnelLangue
 *
 * @ORM\Table(name="professionnel_langue")
 * @ORM\Entity
 */
class ProfessionnelLangue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="prla_id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $prlaId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="prla_prof_id", referencedColumnName="id")
     */
    private $prlaProfId;

    /**
     * @var string
     *
     * @ORM\Column(name="prla_lang_code", type="string", length=4, nullable=false)
     */
    private $prlaLangCode;

    /**
     * @var string
     *
     * @ORM\Column(name="prla_code", type="string", length=32, nullable=false)
     */
    private $prlaCode;

    /**
     * @var string
     *
     * @ORM\Column(name="prla_text", type="text", length=65535, nullable=true)
     */
    private $prlaText;



    /**
     * Get prlaId
     *
     * @return integer 
     */
    public function getPrlaId()
    {
        return $this->prlaId;
    }

    /**
     * Set prlaProfId
     *
     * @param integer $prlaProfId
     * @return ProfessionnelLangue
     */
    public function setPrlaProfId($prlaProfId)
    {
        $this->prlaProfId = $prlaProfId;

        return $this;
    }

    /**
     * Get prlaProfId
     *
     * @return integer 
     */
    public function getPrlaProfId()
    {
        return $this->prlaProfId;
    }

    /**
     * Set prlaLangCode
     *
     * @param string $prlaLangCode
     * @return ProfessionnelLangue
     */
    public function setPrlaLangCode($prlaLangCode)
    {
        $this->prlaLangCode = $prlaLangCode;

        return $this;
    }

    /**
     * Get prlaLangCode
     *
     * @return string 
     */
    public function getPrlaLangCode()
    {
        return $this->prlaLangCode;
    }

    /**
     * Set prlaCode
     *
     * @param string $prlaCode
     * @return ProfessionnelLangue
     */
    public function setPrlaCode($prlaCode)
    {
        $this->prlaCode = $prlaCode;

        return $this;
    }

    /**
     * Get prlaCode
     *
     * @return string 
     */
    public function getPrlaCode()
    {
        return $this->prlaCode;
    }

    /**
     * Set prlaText
     *
     * @param string $prlaText
     * @return ProfessionnelLangue
     */
    public function setPrlaText($prlaText)
    {
        $this->prlaText = $prlaText;

        return $this;
    }

    /**
     * Get prlaText
     *
     * @return string 
     */
    public function getPrlaText()
    {
        return $this->prlaText;
    }
}
