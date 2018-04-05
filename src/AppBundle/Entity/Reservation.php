<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\Column(name="lieu_id", type="integer")
     */
    private $lieuId;

    /**
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="nbre_place", type="string", length=255)
     */
    private $nbrePlace;

    /**
     * @var string
     *
     * @ORM\Column(name="date_reservation", type="string", length=255)
     */
    private $dateReservation;


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
     * Set lieuId
     *
     * @param integer $lieuId
     *
     * @return Reservation
     */
    public function setLieuId($lieuId)
    {
        $this->lieuId = $lieuId;

        return $this;
    }

    /**
     * Get lieuId
     *
     * @return int
     */
    public function getLieuId()
    {
        return $this->lieuId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return Reservation
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set nbrePlace
     *
     * @param string $nbrePlace
     *
     * @return Reservation
     */
    public function setNbrePlace($nbrePlace)
    {
        $this->nbrePlace = $nbrePlace;

        return $this;
    }

    /**
     * Get nbrePlace
     *
     * @return string
     */
    public function getNbrePlace()
    {
        return $this->nbrePlace;
    }

    /**
     * Set dateReservation
     *
     * @param string $dateReservation
     *
     * @return Reservation
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return string
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }
}

