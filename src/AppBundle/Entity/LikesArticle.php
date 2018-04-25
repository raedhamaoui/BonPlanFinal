<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LikesArticle
 *
 * @ORM\Table(name="likes_article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikesArticleRepository")
 */
class LikesArticle
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="likes")
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id")
     */
    private $article;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="likes")
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
     * @return LikesArticle
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return LikesArticle
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set likesBy
     *
     * @param \AppBundle\Entity\User $likesBy
     *
     * @return LikesArticle
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
