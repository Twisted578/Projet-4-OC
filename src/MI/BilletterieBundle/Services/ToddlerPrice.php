<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 16/09/2017
 * Time: 12:55
 */

namespace MI\BilletterieBundle\Services;


class ToddlerPrice
{
    // Test l'âge de la personne et renvoie true si il est âgé de moins de 4 ans

    public function isToddler(\DateTime $date)
    {
        $today = strtotime('today') - (3600 * 24 *365 * 4);
        $toddlerBirthday = $date -> getTimestamp();

        if ($today < $toddlerBirthday)
        {
            return true;
        }else
        {
            return false;
        }
    }

}