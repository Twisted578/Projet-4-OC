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

        $Commande = new Commande();

        $formC = $this->createForm(CommandeType::class, $Commande);


        if ($request->isMethod('GET') && $formC->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($Commande->setNbBillet());
            $em->persist($Commande->setNbBillet());


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
