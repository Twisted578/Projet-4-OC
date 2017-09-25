<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/09/2017
 * Time: 17:41
 */

namespace MI\BilletterieBundle\Services;


class ThousandTickets
{
    //Test si il y a encore des billets dispo
    public function isThousandTickets($dateEntree, $nbTicket)
    {
        $totalTickets = 0;

        foreach ($dateEntree as $command)
        {
            $commandQuantity = $command->getnbTicket();
            $totalTickets += $commandQuantity;
        }

        return (($totalTickets + $nbTicket) > 1000);
    }
}

