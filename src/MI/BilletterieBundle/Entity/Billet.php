<?php

namespace MI\BilletterieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Billet
 *
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="MI\BilletterieBundle\Repository\BilletRepository")
 */
class Billet
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
     * @Assert\Length(
     *     min = 2,
     *     max = 30,
     *     minMessage = "Votre nom doit comprendre au moins {{ limit }} caractères",
     *     maxMessage = "Votre nom doit comprendre au maximum {{ limit }} caractères"
     * )
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="Nom", type="string", length=30)
     */
    private $nom;

    /**
     * @var string
     * @Assert\Length(
     *     min = 2,
     *     max = 30,
     *     minMessage = "Votre prénom doit comprendre au moins {{ limit }} caractères",
     *     maxMessage = "Votre prénom doit comprendre au maximum {{ limit }} caractères"
     * )
     * @Assert\Type(type="string")
     *
     * @ORM\Column(name="Prenom", type="string", length=30)
     */
    private $prenom;

    /**
     * @var string
     * @Assert\Email(
     *     message = "Votre Email '{{ value }}' n'est pas valide.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(name="Email", type="string", length=50, unique=true)
     */
    private $email;

    /**
     * @var date
     *
     * @ORM\Column(name="Age", type="date")
     */
    private $age;



    /**
     * @var bool
     * @Assert\Type(type="bool")
     *
     * @ORM\Column(name="Reduc", type="boolean")
     */
    private $reduc;

    /**
     * @var string
     *
     * @ORM\Column(name="Tarif", type="string", length=6)
     */
    private $tarif;


    /**
     * @var int
     *
     * @ORM\Column(name="Prix", type="smallint")
     */
    private $prix;


    /**
     * @/**
     * @var int
     *
     * @ORM\Column(name="Commande_id", type="integer")
     */
    private $commandeId;

    /**
     * @ORM\ManyToOne(targetEntity="MI\BilletterieBundle\Entity\Commande", inversedBy="billets", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Commande;




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
     * Set nom
     *
     * @param string $nom
     *
     * @return Commande
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Commande
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commande
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set age
     *
     * @param \DateTime $age
     *
     * @return Commande
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return \DateTime
     */
    public function getAge()
    {
        return $this->age;
    }


    /**
     * Set reduc
     *
     * @param boolean $reduc
     *
     * @return Billet
     */
    public function setReduc($reduc)
    {
        $this->reduc = $reduc;

        return $this;
    }

    /**
     * Get reduc
     *
     * @return bool
     */
    public function getReduc()
    {
        return $this->reduc;
    }

    /**
     * Set tarif
     *
     * @param string $tarif
     *
     * @return Billet
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return string
     */
    public function getTarif()
    {
        return $this->tarif;
    }


    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Billet
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set commandeId
     *
     * @param integer $commandeId
     *
     * @return Billet
     */
    public function setCommandeId($commandeId)
    {
        $this->commandeId = $commandeId;

        return $this;
    }

    /**
     * Get commandeId
     *
     * @return int
     */
    public function getCommandeId()
    {
        return $this->commandeId;
    }


    /**
     * Set commande
     *
     * @param \MI\BilletterieBundle\Entity\Commande $commande
     *
     * @return Billet
     */
    public function setCommande(Commande $commande = null)
    {
        $this->Commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \MI\BilletterieBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->Commande;
    }
}
