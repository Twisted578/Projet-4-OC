<?php

namespace MI\BilletterieBundle\Controller;


use MI\BilletterieBundle\Entity\Commande;
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

        $form = $this->createForm(CommandeType::class, $Commande);


        if ($request->isMethod('GET') && $form->handleRequest($request)->isValid()){

            $em = $this->getDoctrine()->getManager();
            $em->persist($Commande->getDateEntree());
            $em->persist($Commande->setNbBillet());


            $request->getSession()->getFlashBag()->add('Notice','C\'est disponible');

            return $this->redirectToRoute('mi_billetterie_champsbillet');

        }

        return $this->render('MIBilletterieBundle:Billetterie:ChoixBillet.html.twig', array('form' => $form->createView()));

    }
    public function champsAction()
    {

    }
}
