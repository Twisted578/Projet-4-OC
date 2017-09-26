<?php

namespace MI\BilletterieBundle\Controller;


use MI\BilletterieBundle\Entity\Billet;
use MI\BilletterieBundle\Entity\Commande;
use MI\BilletterieBundle\Form\BilletType;
use MI\BilletterieBundle\Form\CommandeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('MIBilletterieBundle:Billetterie:index.html.twig');

        return new Response($content);
    }

    public function chooseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Commande = new Commande();
        $form = $this->createForm(CommandeType::class, $Commande);




        if ($form->handleRequest($request)->isValid()){


            $getDateEntree = $form->get('dateEntree')->getData();
            $getNbBillet = $form ->get('NbBillet')->getData();
            $_SESSION['NbBillet'] = $getNbBillet;
            $_SESSION['dateEntree'] = $getDateEntree;

            //Test si il y a encore des billets

            $getThousandTickets = $this->container->get('mi_billetterie.ThousandTickets');

            // Test si le jou est sélectionné est un mardi ou un jour férié

            //$getMuseumClose = $this->container->get('mi_billetterie.MuseumClose');

            //Test pour empecher de commander un billet journée après 14H

            $getHalfTicket = $this->container->get('mi_billetterie.HalfTicket');
            $date = new \DateTime();

            $dateEntree = $em->getRepository('MIBilletterieBundle:Commande')->findBy(array('dateEntree' => $getDateEntree));

            if ($getThousandTickets -> isThousandTickets($dateEntree, $getNbBillet) === true)
            {
                $this -> get('session')->getFlashbag() -> add('info', 'Le musée est complet pour cette date');
                return $this -> redirectToRoute('mi_billetterie_choixbillet');
            }elseif ($getHalfTicket === 'Journée' && $getHalfTicket -> isHalfTicket($date, $getDateEntree) === true)
            {
                $this -> get('session') -> getFlashBag() -> add('info', 'Vous ne pouvez pas acheter un billet jornée après 14h pour aujourd\'hui');
                return $this -> redirectToRoute('mi_billetterie_choixbillet');
            }//elseif ($getMuseumClose -> isMuseumClose($dateEntree ,$year = null) === false)
            {
              //  $this -> get('session') -> getFlashBag() -> add('info', 'Le musée est fermé à cette date là.');
              //  return $this -> redirectToRoute('mi_billetterie_choixbillet');
            }

            // génération du numéro de commande

            $getBookingCode = $this -> container -> get('mi_billetterie.BookingCode');
            $bookingcode = $getBookingCode -> generateCode();
            $Commande -> setBookingCode($bookingcode);
            $em->persist($Commande);
            $em->flush();

            $request->getSession()->getFlashBag()->add('Notice','C\'est disponible');

            return $this->redirectToRoute('mi_billetterie_champsbillet');

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChoixBillet.html.twig', array('form' => $form->createView()));

    }
    public function champsAction(Request $request)
    {

        $Billet = new Billet();

        $form = $this->createForm(BilletType::class, $Billet);

        if ($request->isMethod('GET') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($Billet);

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChampsBillet.html.twig', array('form' => $form->createView()));

    }
}
