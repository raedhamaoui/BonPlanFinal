<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prestataire
 *
 * @ORM\Table(name="prestataire")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrestataireRepository")
 */
class Prestataire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="compagnie", type="string", length=255)
     */
    private $compagnie;

    /**
     * @var string
     *
     * @ORM\Column(name="typeService", type="string", length=255)
     */
    private $typeService;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255, nullable=true)
     */
    private $phoneNumber;


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
     * Set compagnie
     *
     * @param string $compagnie
     *
     * @return Prestataire
     */
    public function setCompagnie($compagnie)
    {
        $this->compagnie = $compagnie;

        return $this;
    }

    /**
     * Get compagnie
     *
     * @return string
     */
    public function getCompagnie()
    {
        return $this->compagnie;
    }

    /**
     * Set typeService
     *
     * @param string $typeService
     *
     * @return Prestataire
     */
    public function setTypeService($typeService)
    {
        $this->typeService = $typeService;

        return $this;
    }

    /**
     * Get typeService
     *
     * @return string
     */
    public function getTypeService()
    {
        return $this->typeService;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Prestataire
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return Prestataire
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set id
     *
     * @return Prestataire
     */
    public function setId($id)
    {

        $this->id = $id;

        return $this;
    }
}

