<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 14/09/2017
 * Time: 12:27
 */

namespace MI\BilletterieBundle\Command;

class BookingCode
{

    //Génération du numéro de commande entre 0 et 1000

    public function generatecode()
    {
        $randomNumber = rand(0, 1000);

        $letters = [ 'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        $i = rand(0, 25);
        $letter = $letters[$i];

        $time = time();

        $bookingCode = $letter . $randomNumber . 'LOUVRE' . $time;

        return $bookingCode;
    }
}