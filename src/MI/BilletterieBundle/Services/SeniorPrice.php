<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/09/2017
 * Time: 16:56
 */

namespace MI\BilletterieBundle\Services;


class SeniorPrice
{
    //Test l'âge de la personne et renvoie true si il est âgé de plus de 60ans
    public function isSenior(\DateTime $date)
    {
        $today = strtotime('today') - (3600 * 24 * 365 * 60);
        $seniorBirthDay = $date -> getTimestamp();

        if ($today > $seniorBirthDay)
        {
            return true;
        }else{
            return false;
        }
    }

}