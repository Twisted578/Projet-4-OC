<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 18/10/2017
 * Time: 14:41
 */

namespace MI\BilletterieBundle\Stripe;

use Flosch\Bundle\StripeBundle\Stripe\StripeClient as BaseStripeClient;

class StripeClient extends BaseStripeClient
{
    public function __construct($stripeApiKey = '')
    {
        parent::__construct($stripeApiKey);

        return $this;
    }
    public function myOwnMethod()
    {

    }
}