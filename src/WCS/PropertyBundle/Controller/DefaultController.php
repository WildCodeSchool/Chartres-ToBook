<?php

namespace WCS\PropertyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSPropertyBundle:Default:index.html.twig');
    }
}
