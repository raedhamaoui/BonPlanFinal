<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lieux
 *
 * @ORM\Table(name="lieux")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LieuxRepository")
 */
class Lieux
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
     * @ORM\Column(name="addresse", type="string", length=255)
     */
    private $addresse;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;


    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="capacite", type="string", length=255)
     */
    private $capacite;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Deals", mappedBy="lieuxId" , cascade={"persist", "remove"})
     */
    private $deals;

    /**
     * @return string
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * @param string $deals
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;
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
     * Set addresse
     *
     * @param string $addresse
     *
     * @return Lieux
     */
    public function setAddresse($addresse)
    {
        $this->addresse = $addresse;

        return $this;
    }

    /**
     * Get addresse
     *
     * @return string
     */
    public function getAddresse()
    {
        return $this->addresse;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Lieux
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return Lieux
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Lieux
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Lieux
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set capacite
     *
     * @param string $capacite
     *
     * @return Lieux
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite
     *
     * @return string
     */
    public function getCapacite()
    {
        return $this->capacite;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->deals = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add deal
     *
     * @param \AppBundle\Entity\Deals $deal
     *
     * @return Lieux
     */
    public function addDeal(\AppBundle\Entity\Deals $deal)
    {
        $this->deals[] = $deal;

        return $this;
    }

    /**
     * Remove deal
     *
     * @param \AppBundle\Entity\Deals $deal
     */
    public function removeDeal(\AppBundle\Entity\Deals $deal)
    {
        $this->deals->removeElement($deal);
    }
}
