<?php

namespace WCS\EmailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSEmailingBundle:Default:index.html.twig');
    }
}
