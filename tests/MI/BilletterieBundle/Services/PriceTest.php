<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 29/11/2017
 * Time: 11:50
 */

namespace tests\MI\BilletterieBundleServices;

use MI\BilletterieBundle\Entity\Billet;
use MI\BilletterieBundle\Entity\Commande;
use MI\BilletterieBundle\Services\Price;

class PriceTest extends \PHPUnit_Framework_TestCase
{
    private $billet;
    private $Commande;
    private $price;
    private $format = 'd/m/Y';

    public function __construct()
    {
        parent::__construct();
        $this->billet = new Billet();
        $this->Commande = new Commande();
        $this->price = new Price();
    }

    public function getPreviousYears($years)
    {
        $time = new \DateTime('now');
        $newTime = $time->modify($years)->format('d/m/Y');
        return $newTime;
    }

    /**
     * Asserts enfant de moins de 4 ans (gratuit)
     */
    public function testPriceToddlerReturnGoodPrice()
    {
        $this->billet->setReduc(false)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-2 years")));
        $this->Commande->addbillet($this->billet)->setType('journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(0, $result);
    }
    /**
     * Asserts enfant entre 4 et 12 ans (8 euros)
     */
    public function testPriceChildGoodPrice()
    {
        $this->billet->setReduc(false)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-5 years")));
        $this->Commande->addbillet($this->billet)->setType('journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(8, $result);
    }
    /**
     * Asserts adulte entre 12 et 60 ans (16 euros)
     */
    public function testPricePersonGoodPrice()
    {
        $this->billet->setReduc(false)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-13 years")));
        $this->Commande->addbillet($this->billet)->setType('journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(16 , $result);
    }
    /**
     * Assert adulte de plus de 60 ans (12 euros)
     */
    public function testPricePersonolderGoodPrice()
    {
        $this->billet->setReduc(false)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-61 years")));
        $this->Commande->addbillet($this->billet)->setType('journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(12, $result);
    }
    /**
     * Assert adulte (12 60 ans) avec reduc 10 euros
     */
    public function testPricePersonDiscountGoodPrice()
    {
        $this->billet->setReduc(true)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-30 years")));
        $this->Commande->addbillet($this->billet)->setType('journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(10, $result);
    }
    /**
     * Assert demi journée donc prix divisé par 2 (adulte de 12 à 60 ans)
     */
    public function testPriceDemiJournéeGoodPrice()
    {
        $this->billet->setReduc(false)->setAge(\DateTime::createFromFormat($this->format, $this->getPreviousYears("-20 years")));
        $this->Commande->addbillet($this->billet)->setType('demi-journée');
        $result = $this->price->calculate($this->Commande);
        $this->assertEquals(8, $result);
    }
}
