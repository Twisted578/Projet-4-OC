<?php

namespace MI\BilletterieBundle\Controller;


use MI\BilletterieBundle\Entity\Billet;
use MI\BilletterieBundle\Entity\Commande;
use MI\BilletterieBundle\Form\BilletType;
use MI\BilletterieBundle\Form\CommandeType;
use MI\BilletterieBundle\Form\InfoStepType;
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
        $Commande = new Commande();
        $form = $this->createForm(CommandeType::class, $Commande);


        if ($form->handleRequest($request)->isValid()){

            // On boucle pour récupérer le nombre de form à afficher en fonctions du nb de billets voulu

            for ($i = 0; $i < $Commande->getNbBillet(); $i++){
                $billet = new Billet();
                $Commande->addBillet($billet);
            }

            // génération du numéro de commande

            $getBookingCode = $this -> container -> get('mi_billetterie.BookingCode');
            $bookingcode = $getBookingCode -> generateCode();
            $Commande -> setBookingCode($bookingcode);


            // enregistrement des données du premier form en session

            $this->get('session')->set('Commande', $Commande);
            return $this->redirectToRoute('mi_billetterie_champsbillet');

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChoixBillet.html.twig', array('form' => $form->createView()));

    }
    public function champsAction(Request $request)
    {
        $Commande = $this->get('session')->get('Commande');

        if (!$Commande)
            throw new \Exception();


        $form = $this->createForm(InfoStepType::class, $Commande);


        if ($form->handleRequest($request)->isValid()){

            $this->get('session')->set('Commande', $Commande);
            return $this->redirectToRoute('paiement');

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChampsBillet.html.twig', array('form' => $form ->createView()));

    }
}
