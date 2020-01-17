<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * se connecter
     * @Route("/login", name="account_login")
     */
    public function login( AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        dump($error);
        return $this->render('account/login.html.twig',[
        'hasError' => $error !==null

        ]);
         
    }

    /**
     * se deconnecter
     * @Route("/logout", name="account_logout")
     * 
     * @return void
     */
  public function logout () 
  {

  }
}
