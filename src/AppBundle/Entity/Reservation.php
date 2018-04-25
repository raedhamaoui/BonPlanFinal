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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Lieux", inversedBy="reserv")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $lieux;

    /**
     * @return mixed
     */
    public function getLieux()
    {
        return $this->lieux;
    }

    /**
     * @param mixed $lieux
     */
    public function setLieux($lieux)
    {
        $this->lieux = $lieux;
    }


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user;

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
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
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
