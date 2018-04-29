<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Plan
 *
 * @ORM\Table(name="plan")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 */
class Plan
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
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lieux", inversedBy="plan")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $lieux;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePublication", type="datetime")
     */
    private $datePublication;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="plan")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $userName;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorie", inversedBy="plan")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $categorie;


    /**
     * Get id
     *
     * @return int
     */

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesPlan", mappedBy="plan")
     */
    private $likes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Media")
     * @ORM\JoinTable(name="plan_media",
     *      joinColumns={@ORM\JoinColumn(name="plan_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="media_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $medias;

    /**
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->ratings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->rate = 0;
        $this->likes = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enabled = true;
        $this->datePublication = new \DateTime();
    }

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
     * Set titre
     *
     * @param string $titre
     *
     * @return Plan
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Plan
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
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Plan
     */
    public function setDatePublication($datePublication)
    {
        $this->datePublication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->datePublication;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     *
     * @return Plan
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
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Plan
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
     * Set lieux
     *
     * @param \AppBundle\Entity\Lieux $lieux
     *
     * @return Plan
     */
    public function setLieux(\AppBundle\Entity\Lieux $lieux = null)
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * Get lieux
     *
     * @return \AppBundle\Entity\Lieux
     */
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * Set userName
     *
     * @param \AppBundle\Entity\User $userName
     *
     * @return Plan
     */
    public function setUserName(\AppBundle\Entity\User $userName = null)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set categorie
     *
     * @param \AppBundle\Entity\Categorie $categorie
     *
     * @return Plan
     */
    public function setCategorie(\AppBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \AppBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add rating
     *
     * @param \AppBundle\Entity\Rating $rating
     *
     * @return Plan
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
     * Add like
     *
     * @param \AppBundle\Entity\LikesPlan $like
     *
     * @return Plan
     */
    public function addLike(\AppBundle\Entity\LikesPlan $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \AppBundle\Entity\LikesPlan $like
     */
    public function removeLike(\AppBundle\Entity\LikesPlan   $like)
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

    /**
     * Add media
     *
     * @param \AppBundle\Entity\Media $media
     *
     * @return Plan
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
}
