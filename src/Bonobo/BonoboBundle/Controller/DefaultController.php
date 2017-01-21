<?php

namespace Bonobo\BonoboBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BonoboBundle:Default:index.html.twig',array('name' => $name));
    }
}
