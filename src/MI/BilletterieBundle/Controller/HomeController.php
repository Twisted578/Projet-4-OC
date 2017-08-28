<?php

namespace MI\BilletterieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('MIBilletterieBundle:Billetterie:index.html.twig');

        return new Response($content);
    }

    public function chooseAction()
    {
        $content = $this->get('templating')->render('MIBilletterieBundle:Billetterie:ChoixBillet.html.twig');

        return new Response($content);
    }
}
