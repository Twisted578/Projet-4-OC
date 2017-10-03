<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 29/09/2017
 * Time: 18:16
 */

namespace MI\BilletterieBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class MoreThanThousandTickets
 * @Annotation
 * @package MI\BilletterieBundle\Validator\Constraints
 */
class MoreThanThousandTickets extends Constraint
{
    public $message = 'Le nombre de billets vendus a atteint son maximum (1000).';


}