<?php
/**
 * Created by PhpStorm.
 * User: gueno
 * Date: 25/09/2017
 * Time: 18:25
 */

namespace MI\BilletterieBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    public function testForm ()
    {
        if ($req->isXMLHttpRequest())
        {
            $data = $req->get('')
        }
    }
}