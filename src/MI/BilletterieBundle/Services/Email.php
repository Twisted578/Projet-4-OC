<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 19/10/2017
 * Time: 12:18
 */

namespace MI\BilletterieBundle\Services;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class Email
{
    private $mailer;
    private $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendEmail($Commande, $email, $bookingPrice)
    {
        $mailer = $this->get('mailer');
        $message = (new \Swift_Message('Réservation'))
            ->setContentType("text/html")
            ->setSubject('Confirmation de réservation pour le musée du Louvre')
            ->setFrom('guenole578@gmail.com')
            ->setTo($email)
            ->setBody($this->templating->render('Emails/reservation.html.twig', array(
                'Commande' => $Commande,
                'bookingPrice' => $bookingPrice,
            )));
        $mailer->send($message);
    }
}
