<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicationRepository")
 */
class Publication
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="experiences")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $createdBy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateExperience", type="date")
     */
    private $dateExperience;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=65)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=65)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2048)
     */
    private $description;

    /**
     * @var integer
     * MAX = 5, total vote, moyenne
     * @ORM\Column(name="rate", type="integer")
     */
    private $rate;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="votedTo")
     */
    private $ratings;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesPublication", mappedBy="publication")
     */
    private $likes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Media")
     * @ORM\JoinTable(name="publications_media",
     *      joinColumns={@ORM\JoinColumn(name="pub_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $medias;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    public function __construct() // par default valeurs
    {
        $this->createdAt = new \DateTime();
        $this->ratings = new ArrayCollection();
        $this->rate = 0;
        $this->enabled = true;
        $this->likes = new ArrayCollection();
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
     * @return Publication
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
     * Set dateExperience
     *
     * @param \DateTime $dateExperience
     *
     * @return Publication
     */
    public function setDateExperience($dateExperience)
    {
        $this->dateExperience = $dateExperience;

        return $this;
    }

    /**
     * Get dateExperience
     *
     * @return \DateTime
     */
    public function getDateExperience()
    {
        return $this->dateExperience;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Publication
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Publication
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Publication
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Publication
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Add media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return Publication
     */
    public function addMedia(\AppBundle\Entity\Media $media)
    {
        $this->medias[] = $media;

        return $this;
    }

    /**
     * Remove media
     *
     * @param \AppBundle\Entity\Media $media
     */
    public function removeMedia(\AppBundle\Entity\Media $media)
    {
        $this->medias->removeElement($media);
    }

    /**
     * Get medias
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMedias()
    {
        return $this->medias;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Publication
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Add rating
     *
     * @param \AppBundle\Entity\Rating $rating
     *
     * @return Publication
     */
    public function addRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings[] = $rating;

        return $this;
    }

    /**
     * Remove rating
     *
     * @param \AppBundle\Entity\Rating $rating
     */
    public function removeRating(\AppBundle\Entity\Rating $rating)
    {
        $this->ratings->removeElement($rating);
    }

    /**
     * Get ratings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Publication
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * Add like
     *
     * @param \AppBundle\Entity\LikesPublication $like
     *
     * @return Publication
     */
    public function addLike(\AppBundle\Entity\LikesPublication $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \AppBundle\Entity\LikesPublication $like
     */
    public function removeLike(\AppBundle\Entity\LikesPublication $like)
    {
        $this->likes->removeElement($like);
    }

    /**
     * Get likes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikes()
    {
        return $this->likes;
    }
}
