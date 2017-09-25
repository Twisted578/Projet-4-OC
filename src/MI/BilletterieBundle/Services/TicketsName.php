<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 16/09/2017
 * Time: 13:27
 */

namespace MI\BilletterieBundle\Services;


class TicketsName
{
    // Nom du ticket en fonction de la date de naissance

    private $toddlerPrice;
    private $childPrice;
    private $seniorPrice;

    public function __construct(ToddlerPrice $toddlerPrice, ChildPrice $childPrice, SeniorPrice $seniorPrice)
    {
        $this->toddlerPrice = $toddlerPrice;
        $this->childPrice   = $childPrice;
        $this->seniorPrice  = $seniorPrice;
    }

    public function isName($date)
    {
        if ($this->toddlerPrice->isToddler($date) === true)
        {
            return 'Gratuit';
        }elseif ($this->childPrice->isChild($date) === true)
        {
            return 'Billet Enfant';
        }elseif ($this->seniorPrice->isSenior($date) === true)
        {
            return 'Billet Senior';
        }else
        {
            return 'Billet Normal';
        }
    }

}