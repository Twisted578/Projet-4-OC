<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 25/09/2017
 * Time: 18:25
 */

namespace MI\BilletterieBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class AjaxController extends Controller
{
    public function testFormAction (Request $req)
    {
        if ($req->isXMLHttpRequest())
        {
            $donnees = $req->get($_SESSION['NbBillet'], $_SESSION['dateEntree']);
            return new JsonResponse(array('data' => json_encode($donnees)));
        }
        return new Response("Erreur : Ce n'est pas une requête Ajax", 400);
    }
}