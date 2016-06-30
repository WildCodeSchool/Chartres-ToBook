<?php

namespace WCS\SMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSSMSBundle:Default:index.html.twig');
    }
}
