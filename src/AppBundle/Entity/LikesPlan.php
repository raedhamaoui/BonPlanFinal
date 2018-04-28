<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikesPlan
 *
 * @ORM\Table(name="likes_plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikesPlanRepository")
 */
class LikesPlan
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
     * @var int
     *
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Plan", inversedBy="likes")
     * @ORM\JoinColumn(name="plan_id", referencedColumnName="id")
     */
    private $plan;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="likesPlan")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $likesBy;


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
     * Set note
     *
     * @param integer $note
     *
     * @return LikesPlan
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set plan
     *
     * @param \AppBundle\Entity\Plan $plan
     *
     * @return LikesPlan
     */
    public function setPlan(\AppBundle\Entity\Plan $plan = null)
    {
        $this->plan = $plan;

        return $this;
    }

    /**
     * Get plan
     *
     * @return \AppBundle\Entity\Plan
     */
    public function getPlan()
    {
        return $this->plan;
    }

    /**
     * Set likesBy
     *
     * @param \AppBundle\Entity\User $likesBy
     *
     * @return LikesPlan
     */
    public function setLikesBy(\AppBundle\Entity\User $likesBy = null)
    {
        $this->likesBy = $likesBy;

        return $this;
    }

    /**
     * Get likesBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getLikesBy()
    {
        return $this->likesBy;
    }
}
