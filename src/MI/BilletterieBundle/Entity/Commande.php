<?php

namespace MI\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="MI\BilletterieBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\Column(name="PrixTotal", type="smallint")
     */
    private $prixTotal;


    /**
     * @var int
     *
     * @ORM\Column(name="NbBillet", type="smallint")
     */
    private $NbBillet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_achat", type="datetime", unique=true)
     */
    private $dateAchat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_entree", type="datetime")
     */
    private $dateEntree;

    /**
     * @var string
     *
     * @ORM\Column(name="bookingCode", type="string", length=255, unique=true)
     */
    private $bookingCode;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Billet", mappedBy="Commande", cascade={"persist"})
     */
    private $Billet;

    public function __construct()
    {
        $this->dateEntree = new \DateTime();
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
     * Set prixTotal
     *
     * @param integer $prixTotal
     *
     * @return Commande
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return int
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }


    /**
     * Set NbBillet
     *
     * @param integer $NbBillet
     *
     * @return Commande
     */
    public function setNbBillet($NbBillet)
    {
        $this->NbBillet = $NbBillet;

        return $this;
    }

    /**
     * Get NbBillet
     *
     * @return int
     */
    public function getNbBillet()
    {
        return $this->NbBillet;
    }

    /**
     * Set dateAchat
     *
     * @param \DateTime $dateAchat
     *
     * @return Commande
     */
    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = $dateAchat;

        return $this;
    }

    /**
     * Get dateAchat
     *
     * @return \DateTime
     */
    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    /**
     * Set dateEntree
     *
     * @param \DateTime $dateEntree
     *
     * @return Commande
     */
    public function setDateEntree($dateEntree)
    {
        $this->dateEntree = $dateEntree;

        return $this;
    }

    /**
     * Get dateEntree
     *
     * @return \DateTime
     */
    public function getDateEntree()
    {
        return $this->dateEntree;
    }


    /**
     * Set bookingCode
     *
     * @param string $bookingCode
     *
     * @return Commande
     */
    public function setBookingCode($bookingCode)
    {
        $this->bookingCode = $bookingCode;

        return $this;
    }

    /**
     * Get bookingCode
     *
     * @return string
     */
    public function getBookingCode()
    {
        return $this->bookingCode;
    }

    /**
     * Get billet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBillet()
    {
        return $this->Billet;
    }


    public function addTicket(Billet $billet)
    {
        $this->Billet[] = $billet;

        return $this;
    }


    public function removeTicket(Billet $billet)
    {
        $this->Billet->removeElement($billet);
    }
}
