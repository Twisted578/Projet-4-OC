<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 16/10/2017
 * Time: 15:34
 */

namespace MI\BilletterieBundle\Services;

use MI\BilletterieBundle\Entity\Commande;

class Price
{
    private function getPrice($age, $reduc)
    {
        if ($age >= 0 && $age <= 4) {
            return 0;
        }
        if ($reduc){
            return 10;
        }
        if ($age > 4 && $age < 12){
            return 8;
        }
        if ($age >= 12 && $age <= 60){
            return 16;
        }
        return 12;
    }

    public function calculate(Commande $Commande)
    {
        $total = null;

        // Date en cours
        $today = new \DateTime();
        $today -> format('d-m-Y');

        // Tableau billets
        $billets = $Commande->getbillet();

        foreach ($billets as $billet) {

            $birthdate = $billet->getAge();
            $reduc = $billet->getReduc();

            $interval = $birthdate->diff($today);

            $clientsAge = $interval->y;

            $prix = $this->getPrice($clientsAge, $reduc);

            if ($Commande->getType()== "demi-journée"){
                $prix = $prix / 2;
            }
            $billet->setPrix($prix);
            $total += $prix;
        }
        return $total;
    }

}