<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RatingRepository")
 */
class Rating
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
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="ratings")
     * @ORM\JoinColumn(name="voted_by_id", referencedColumnName="id")
     */
    private $votedBy;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication", inversedBy="ratings")
     * @ORM\JoinColumn(name="pub_id", referencedColumnName="id")
     */
    private $votedTo;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Rating
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Rating
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set votedBy
     *
     * @param \AppBundle\Entity\User $votedBy
     *
     * @return Rating
     */
    public function setVotedBy(\AppBundle\Entity\User $votedBy = null)
    {
        $this->votedBy = $votedBy;

        return $this;
    }

    /**
     * Get votedBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getVotedBy()
    {
        return $this->votedBy;
    }

    /**
     * Set votedTo
     *
     * @param \AppBundle\Entity\Publication $votedTo
     *
     * @return Rating
     */
    public function setVotedTo(\AppBundle\Entity\Publication $votedTo = null)
    {
        $this->votedTo = $votedTo;

        return $this;
    }

    /**
     * Get votedTo
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getVotedTo()
    {
        return $this->votedTo;
    }
}
