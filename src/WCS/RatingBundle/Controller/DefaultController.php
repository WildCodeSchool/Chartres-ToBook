<?php

namespace WCS\RatingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WCSRatingBundle:Default:index.html.twig');
    }
}
