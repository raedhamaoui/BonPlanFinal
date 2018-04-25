<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="titre", type="string", length=65)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=1024)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesArticle", mappedBy="article")
     */
    private $likes;

    /**
     * @var \DateTime
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Media",cascade={"all"})
     * @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $createdBy;





    public function __construct()
    {
        $this->enabled = true;
        $this->likes = new ArrayCollection();
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
     * Set text
     *
     * @param string $text
     *
     * @return Article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Article
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
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
     * Set image
     *
     * @param \AppBundle\Entity\Media $image
     *
     * @return Article
     */
    public function setImage(\AppBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return Article
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
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     *
     * @return Article
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
     * Add like
     *
     * @param \AppBundle\Entity\LikesArticle $like
     *
     * @return Article
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
}
