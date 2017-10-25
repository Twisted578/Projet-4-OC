<?php

namespace MI\BilletterieBundle\Controller;


use MI\BilletterieBundle\Entity\Billet;
use MI\BilletterieBundle\Entity\Commande;
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
            return $this->redirectToRoute('mi_billetterie_paiementbillet');

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChampsBillet.html.twig', array('form' => $form ->createView()));

    }
    public function paiementAction()
    {
        $Commande = $this->get('session')->get('Commande');
        $prix = $this->get('mi_billetterie.price')->calculate($Commande);
        $this->get('session')->set('prix', $prix);


        return $this->render('MIBilletterieBundle:Billetterie:PaiementBillet.html.twig', array(
            'Commande' => $Commande,
            'prix'     => $prix,
        ));
    }
    public function checkoutAction(Request $request)
    {
        $session = $request->getSession();
        $prix = $this->get('session')->get('prix');
        $bookingPrice = $prix;
        $Commande = $this->get('session')->get('Commande');

        \Stripe\Stripe::setApiKey("pk_test_shD23B5uunMft5ppuyTOCVsJ");
        $token = $_POST['stripeToken'];

       try{
            $charge = \Stripe\Charge::create(array(
                "amount" => $prix."00",
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - Musée du Louvre"
            ));

            $stripeinfo = \Stripe\Token::retrieve($token);
            $clientEmail = $stripeinfo->email;

            $em = $this->getDoctrine()->getManager();
            $em->persist($session->get('Commande'));
            $em->flush();

            foreach ($Commande->getbillet() as $billet)
            {
                $billet->setCommande($Commande);
                $em->persist($billet);
            }
            $em->flush();

            $this->get('mi_billetterie.Email')->sendEmail($Commande, $clientEmail, $bookingPrice);

            $session->invalidate();

           return $this->render('Billetterie/sucess.html.twig');
        } catch (\Stripe\Error\Card $e){
           $session->getFlashBag()->add("Error", "Le paiement a échoué. Veuillez recommencer.");
           return $this->redirectToRoute("mi_billetterie_paiementbillet");
       }
    var_dump($Commande);
    }
}
