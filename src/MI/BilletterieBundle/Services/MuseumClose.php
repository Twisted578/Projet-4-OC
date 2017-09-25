<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 18/09/2017
 * Time: 11:26
 */

namespace MI\BilletterieBundle\Services;


class MuseumClose
{
    // Test si le jour sélectionné est férié ou que le musée est fermé

    public function isMuseumClose($dateEntree ,$year = null)
    {
        if ($year === null)
        {
            $year = intval(date('Y'));
        }

        $holidays = array(

            mktime(0, 0, 0,5, 1, $year),    // Fête du Travail
            mktime(0, 0, 0, 11, 1, $year),  // Toussaint
            mktime(0, 0, 0, 12, 25, $year)  // Noël
        );

        sort($holidays);


        if (date("l", strtotime($dateEntree)) == 'Tuesday') {
            return false;

        } else {

            for ($i = 0; $i < sizeof($holidays); $i++) {
                if (date("l", strtotime($dateEntree)) == $holidays[$i]) {
                    return false;
                }
            }

            return true;
        }


    }

}