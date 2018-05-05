<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Publication", mappedBy="createdBy")
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="votedBy")
     */
    private $ratings;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesArticle", mappedBy="likesBy")
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesPublication", mappedBy="likesBy")
     */
    private $likesPub;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesPlan", mappedBy="likesBy")
     */
    private $likesPlan;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="createdBy")
     */
    private $articles;

    /**
     * Many Users have Many Groups.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Events", inversedBy="participants")
     * @ORM\JoinTable(name="users_participants")
     */
    private $eventsParticipated;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Events", mappedBy="createdBy")
     */
    private $eventsCreated;


    public function __construct()
    {
        parent::__construct();
        $this->experiences = new ArrayCollection();
        $this->ratings = new ArrayCollection();
        $this->articles = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->likesPub = new ArrayCollection();
        $this->likesPlan = new ArrayCollection();
        $this->eventsParticipated = new ArrayCollection();
        $this->eventsCreated = new ArrayCollection();
        // your own logic
    }

    /**
     * Add experience
     *
     * @param \AppBundle\Entity\Publication $experience
     *
     * @return User
     */
    public function addExperience(\AppBundle\Entity\Publication $experience)
    {
        $this->experiences[] = $experience;

        return $this;
    }

    /**
     * Remove experience
     *
     * @param \AppBundle\Entity\Publication $experience
     */
    public function removeExperience(\AppBundle\Entity\Publication $experience)
    {
        $this->experiences->removeElement($experience);
    }

    /**
     * Get experiences
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExperiences()
    {
        return $this->experiences;
    }

    /**
     * Add rating
     *
     * @param \AppBundle\Entity\Rating $rating
     *
     * @return User
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
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add like
     *
     * @param \AppBundle\Entity\LikesArticle $like
     *
     * @return User
     */
    public function addLike(\AppBundle\Entity\LikesArticle $like)
    {
        $this->likes[] = $like;

        return $this;
    }

    /**
     * Remove like
     *
     * @param \AppBundle\Entity\LikesArticle $like
     */
    public function removeLike(\AppBundle\Entity\LikesArticle $like)
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
     * Add likesPub
     *
     * @param \AppBundle\Entity\LikesPublication $likesPub
     *
     * @return User
     */
    public function addLikesPub(\AppBundle\Entity\LikesPublication $likesPub)
    {
        $this->likesPub[] = $likesPub;

        return $this;
    }

    /**
     * Remove likesPub
     *
     * @param \AppBundle\Entity\LikesPublication $likesPub
     */
    public function removeLikesPub(\AppBundle\Entity\LikesPublication $likesPub)
    {
        $this->likesPub->removeElement($likesPub);
    }

    /**
     * Get likesPub
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikesPub()
    {
        return $this->likesPub;
    }

    /**
     * Add eventsParticipated
     *
     * @param \AppBundle\Entity\Events $eventsParticipated
     *
     * @return User
     */
    public function addEventsParticipated(\AppBundle\Entity\Events $eventsParticipated)
    {
        $this->eventsParticipated[] = $eventsParticipated;

        return $this;
    }

    /**
     * Remove eventsParticipated
     *
     * @param \AppBundle\Entity\Events $eventsParticipated
     */
    public function removeEventsParticipated(\AppBundle\Entity\Events $eventsParticipated)
    {
        $this->eventsParticipated->removeElement($eventsParticipated);
    }

    /**
     * Get eventsParticipated
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventsParticipated()
    {
        return $this->eventsParticipated;
    }

    /**
     * Add eventsCreated
     *
     * @param \AppBundle\Entity\Events $eventsCreated
     *
     * @return User
     */
    public function addEventsCreated(\AppBundle\Entity\Events $eventsCreated)
    {
        $this->eventsCreated[] = $eventsCreated;

        return $this;
    }

    /**
     * Remove eventsCreated
     *
     * @param \AppBundle\Entity\Events $eventsCreated
     */
    public function removeEventsCreated(\AppBundle\Entity\Events $eventsCreated)
    {
        $this->eventsCreated->removeElement($eventsCreated);
    }

    /**
     * Get eventsCreated
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEventsCreated()
    {
        return $this->eventsCreated;
    }

    /**
     * Add likesPlan
     *
     * @param \AppBundle\Entity\LikesPlan $likesPlan
     *
     * @return User
     */
    public function addLikesPlan(\AppBundle\Entity\LikesPlan $likesPlan)
    {
        $this->likesPlan[] = $likesPlan;

        return $this;
    }

    /**
     * Remove likesPlan
     *
     * @param \AppBundle\Entity\LikesPlan $likesPlan
     */
    public function removeLikesPlan(\AppBundle\Entity\LikesPlan $likesPlan)
    {
        $this->likesPlan->removeElement($likesPlan);
    }

    /**
     * Get likesPlan
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLikesPlan()
    {
        return $this->likesPlan;
    }

   }
