<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 16/09/2017
 * Time: 12:47
 */

namespace MI\BilletterieBundle\Services;


class GetPrice
{
    // Détermine le prix du billet en fonction de la date de naissance

    private $toddlerPrice;
    private $childPrice;
    private $seniorPrice;

    public function __construct(ToddlerPrice $toddlePrice, ChildPrice $childPrice, SeniorPrice $seniorPrice)
    {
        $this->toddlerPrice = $toddlePrice;
        $this->childPrice  = $childPrice;
        $this->seniorPrice = $seniorPrice;
    }

    public function isPrice($date)
    {
        if ($this->toddlerPrice->isToddler($date) === true)
        {
            return 0;
        }elseif ($this->childPrice->isChild($date) === true)
        {
            return 8;
        }elseif ($this->seniorPrice->isSenior($date) === true)
        {
            return 12;
        }else
        {
            return 16;
        }
    }



}