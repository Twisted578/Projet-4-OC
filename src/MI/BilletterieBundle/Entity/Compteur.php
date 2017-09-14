<?php

namespace MI\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compteur
 *
 * @ORM\Table(name="compteur")
 * @ORM\Entity(repositoryClass="MI\BilletterieBundle\Repository\CompteurRepository")
 */
class Compteur
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
     * @ORM\Column(name="date_jour_visite", type="datetime")
     */
    private $dateJourVisite;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_ticket", type="integer")
     */
    private $nbTicket;


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
     * Set dateJourVisite
     *
     * @param \DateTime $dateJourVisite
     *
     * @return Compteur
     */
    public function setDateJourVisite($dateJourVisite)
    {
        $this->dateJourVisite = $dateJourVisite;

        return $this;
    }

    /**
     * Get dateJourVisite
     *
     * @return \DateTime
     */
    public function getDateJourVisite()
    {
        return $this->dateJourVisite;
    }

    /**
     * Set nbTicket
     *
     * @param integer $nbTicket
     *
     * @return Compteur
     */
    public function setNbTicket($nbTicket)
    {
        $this->nbTicket = $nbTicket;

        return $this;
    }

    /**
     * Get nbTicket
     *
     * @return int
     */
    public function getNbTicket()
    {
        return $this->nbTicket;
    }
}

