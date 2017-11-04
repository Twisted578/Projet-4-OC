<?php

namespace MI\BilletterieBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MI\BilletterieBundle\Validator\Constraints as Assert;
use MI\BilletterieBundle\Validator\Constraints\MoreThanThousandTickets;
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
     * @MoreThanThousandTickets()
     *
     * @ORM\Column(name="NbBillet", type="smallint")
     *
     */
    private $NbBillet;

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
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=50)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="Billet", mappedBy="Commande", cascade={"persist", "remove"})
     */
    private $billets;

    public function __construct()
    {
        $this->dateEntree = new \DateTime();
        $this->billets    = new ArrayCollection();
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
    public function getbillet()
    {
        return $this->billets;
    }

    /**
     * Add Billet
     *
     * @param \MI\BilletterieBundle\Entity\Billet $billet
     *
     * @return Commande
     */
    public function addbillet(\MI\BilletterieBundle\Entity\Billet $billet)
    {
        $this->billets[] = $billet;

        return $this;
    }

    /**
     * Remove billet
     *
     * @param \MI\BilletterieBundle\Entity\Billet $billet
     */
    public function removebillet(\MI\BilletterieBundle\Entity\Billet $billet)
    {
        $this->billets->removeElement($billet);
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Commande
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
