<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/09/2017
 * Time: 16:28
 */

namespace MI\BilletterieBundle\Services;


class HalfTicket
{

    //Contrôle si le ticket a été acheté après 14h
    public function isHalfTicket(\DateTime $dateTime, \DateTime $dateEntree)
    {
        $todayMidnight = strtotime('today midnight');
        $today14h = $todayMidnight + (60 * 60 *14);

        $currentTime = $dateTime -> getTimestamp();

        $date = $dateTime -> format('Y-m-d');
        $bookingDate = $dateEntree -> format('Y-m(d');

        if ($bookingDate == $date)
        {
            if ($currentTime > $today14h)
            {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}