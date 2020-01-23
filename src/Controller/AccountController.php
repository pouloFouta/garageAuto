<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
        $username = $utils->getLastUsername();
        return $this->render('account/login.html.twig',[
        'hasError' => $error !==null,
        'username' => $username
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

   /**
     * devenir membre 
     * 
     * @Route("/register", name="account_register")
     * 
     */
    public function register (Request $request, EntityManagerInterface  $manager, UserPasswordEncoderInterface $encoder ) 
    {
         $user = new User();
         
         $form = $this->createForm(RegistrationType::class, $user);

         $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $hash= $encoder->encodePassword($user, $user->getMotDePasse());
            $user->setMotDePasse($hash);
            $manager->persist($user);
            $manager->flush($user);

            $this->addFlash(
                    'success', 'Votre compte est bien crée, vous pouvez maintenant vous connectez au site !');

            return $this->redirectToRoute('account_login');

        }

         return $this->render('account/registration.html.twig', [
             'form' =>$form->createView()

         ]);
    }
}
