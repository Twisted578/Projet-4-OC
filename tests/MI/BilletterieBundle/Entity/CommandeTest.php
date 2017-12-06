<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 06/12/2017
 * Time: 17:45
 */

namespace MI\BilletterieBundle\Entity;


class CommandeTest extends \PHPUnit_Framework_TestCase
{
    private $Commande;

    public function __construct()
    {
        parent::__construct();
        $this->Commande = new Commande();
    }

    public function testCommandeDate()
    {
       $this->Commande->setDateEntree(new \DateTime('06/12/2017'));
       $this->assertNotEquals(new \DateTime('08/12/2017'), $this->Commande->getDateEntree());
       $this->assertEquals(new \DateTime('06/12/2017'), $this->Commande->getDateEntree());
    }

    public function testCommandeType()
    {
        $this->Commande->setType('journée');
        $this->assertNotEquals('Demi-journée', $this->Commande->getType());
        $this->assertEquals('journée', $this->Commande->getType());
    }

    public function testCommandeNbBillet()
    {
        $this->Commande->setNbBillet('3');
        $this->assertNotEquals('5', $this->Commande->getNbBillet());
        $this->assertEquals('3', $this->Commande->getNbBillet());
    }
}
