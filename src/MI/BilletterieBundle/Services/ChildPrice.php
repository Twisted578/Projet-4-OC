<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/09/2017
 * Time: 16:07
 */

namespace MI\BilletterieBundle\Services;


class ChildPrice
{

    //Test l'âge de la personne et renvoie true si il est âgé de 4 à 12 ans
    public function isChild(\DateTime $date)
    {
        $today12 = strtotime('today') - (3600 * 24 * 365 * 12);
        $today4  = strtotime('today') - (3600 * 24 * 365 * 4);
        $childBirthday = $date->getTimestamp();

        if ($childBirthday < $today4 && $childBirthday > $today12)
        {
            return true;
        }else{
            return false;
        }
    }

}


