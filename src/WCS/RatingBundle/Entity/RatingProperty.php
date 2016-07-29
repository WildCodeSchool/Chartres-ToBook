<?php

namespace WCS\RatingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RatingProperty
 *
 * @ORM\Table(name="rating_property")
 * @ORM\Entity(repositoryClass="WCS\RatingBundle\Repository\RatingPropertyRepository")
 */
class RatingProperty
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="WCS\PropertyBundle\Entity\Professionnel")
     * @ORM\JoinColumn(name="prof_id", referencedColumnName="id")
     */
    private $profId;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $userId;

    /**
     * @var float
     *
     * @ORM\Column(name="rating1", type="float")
     */
    private $rating1;

    /**
     * @var float
     *
     * @ORM\Column(name="rating2", type="float")
     */
    private $rating2;

    /**
     * @var float
     *
     * @ORM\Column(name="rating3", type="float")
     */
    private $rating3;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

/**
*   GET et SET DE Clées étrangères
*/
    /**
    * Get profId
    * 
    * @return integer
    */
    public function getProfId()
    {
        return $this->profId;
    }

    /**
    * Set profId
    * 
    * @param integer $profId
    * @return RatingProperty
    */
    public function setProfId($profId)
    {   
        $this->profId = $profId;

        return $this;
    }


    /**
    * Get userId
    * 
    * @return integer
    */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
    * Set userId
    * 
    * @param integer $userId
    * @return RatingProperty
    */
    public function setUserId($userId)
    {   
        $this->userId = $userId;

        return $this;
    }    
/**
*   FIN GET et SET DE Clées étrangères
*/

    /**
     * Set rating1
     *
     * @param float $rating1
     * @return RatingProperty
     */
    public function setRating1($rating1)
    {
        $this->rating1 = $rating1;

        return $this;
    }

    /**
     * Get rating1
     *
     * @return float 
     */
    public function getRating1()
    {
        return $this->rating1;
    }

    /**
     * Set rating2
     *
     * @param float $rating2
     * @return RatingProperty
     */
    public function setRating2($rating2)
    {
        $this->rating2 = $rating2;

        return $this;
    }

    /**
     * Get rating2
     *
     * @return float 
     */
    public function getRating2()
    {
        return $this->rating2;
    }

    /**
     * Set rating3
     *
     * @param float $rating3
     * @return RatingProperty
     */
    public function setRating3($rating3)
    {
        $this->rating3 = $rating3;

        return $this;
    }

    /**
     * Get rating3
     *
     * @return float 
     */
    public function getRating3()
    {
        return $this->rating3;
    }
}
