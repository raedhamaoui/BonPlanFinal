<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikesPublication
 *
 * @ORM\Table(name="likes_publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikesPublicationRepository")
 */
class LikesPublication
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publication", inversedBy="likes")
     * @ORM\JoinColumn(name="publication_id", referencedColumnName="id")
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="likesPub")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $likesBy;

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
     * Set note
     *
     * @param integer $note
     *
     * @return LikesPublication
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set publication
     *
     * @param \AppBundle\Entity\Publication $publication
     *
     * @return LikesPublication
     */
    public function setPublication(\AppBundle\Entity\Publication $publication = null)
    {
        $this->publication = $publication;

        return $this;
    }

    /**
     * Get publication
     *
     * @return \AppBundle\Entity\Publication
     */
    public function getPublication()
    {
        return $this->publication;
    }

    /**
     * Set likesBy
     *
     * @param \AppBundle\Entity\User $likesBy
     *
     * @return LikesPublication
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
