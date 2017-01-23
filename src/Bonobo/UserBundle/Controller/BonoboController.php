<?php

namespace Bonobo\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Bonobo\UserBundle\Entity\User;

class BonoboController extends Controller
{
    public function listeAmisAction()
    {
        $utilisateur= $this->getUser();
        $idAmi = $utilisateur->getIdAmi();
        $repository = $this->getDoctrine()->getRepository('BonoboUserBundle:User');
        for($i = 0, $size = count($idAmi); $i < $size; ++$i) {
            $ami = $repository->findById($idAmi[$i]);
            return $this->render('BonoboUserBundle:Bonobo:listeAmis.html.twig', array(
                'amis' => $ami,
            ));
        }

        /*$em = $this->getDoctrine()->getManager();
        $query = $em->createQuery("
          SELECT u.username,u.age,u.famille,u.race,u.nourriture 
              FROM BonoboUserBundle:User u 
                  WHERE u.id in
                    (SELECT uu.user_target from BonoboUserBundle:User uu WHERE uu.user_target='$id')
                  ");
        $donnees = $query->getResult();*/
    }
}
