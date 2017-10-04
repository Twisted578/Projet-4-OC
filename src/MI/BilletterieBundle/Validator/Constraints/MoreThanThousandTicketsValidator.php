<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 29/09/2017
 * Time: 16:41
 */

namespace MI\BilletterieBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MoreThanThousandTicketsValidator extends ConstraintValidator
{
    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack ,EntityManager $em)
    {
        $this->requestStack = $requestStack;
        $this->em           = $em;
    }

    public function validate($value, Constraint $constraint)
    {

        //Recherche la requete
        $request = $this->requestStack->getCurrentRequest();

        //Recherche de la date séléctionné
        $selectedDate = $request->request->get('mi_billetteriebundle_choixbillet')['dateEntree'];

        //Nb de bilets demandé par l'utilisateur
        $nbOfTickets = $request->request->get('mi_billetteriebundle_choixbillet')['NbBillet'];

        $em = $this->em;

        //Recherche de toutes les réservation faites à cette même date
        $totalTicket = $em->getRepository('MIBilletterieBundle:Commande')->findTotalTickets(\DateTime::createFromFormat('d/m/Y', $selectedDate));

        $remainingTickets = 1000 - $totalTicket;

        if ($nbOfTickets > $remainingTickets)
        {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}