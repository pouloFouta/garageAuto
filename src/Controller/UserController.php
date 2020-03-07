<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/myAccount", name="user_show")
     */
    public function index()
    {
       

        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()
            
        ]);
    }

    
    /**
     * @Route("/user/reparations", name="reparation")
     */
    
    public function reparations ()
    {
        return $this->render('user/reparation.html.twig');

    }

    /**
     * @Route("/user/factures", name="factures")
     */
    
    public function factures ()
    {
        return $this->render('user/facture.html.twig');

    }
}
