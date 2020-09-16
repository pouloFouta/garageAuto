<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManager;
use App\Form\PasswordUpdateType;
use App\Form\ResetpasswordType;
use App\Repository\UserRepository;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class AccountController extends AbstractController
{
    /**
     * se connecter
     * @Route("/login", name="account_login")
     * 
     * pour symfony si aucune redirection n'est préciser il renvoie vers la page d'accueil après authentification, 
     * symfony gère lui même authentification avec le form_login et le check_path (quelle magie derrière !)
     */
    public function login( AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        //dump($error);
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
        //$lesPersonnes =[];
        $user = new Client();
         
         $form = $this->createForm(RegistrationType::class, $user);

         $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {   
            $hash= $encoder->encodePassword($user, $user->getMotDePasse());
            $user->setMotDePasse($hash);
            //$role = new Role ();
            //$role->setTitle('ROLE_USER');
           // $personne->addPersonneRole($role);
            //$manager->persist($role);
            $manager->persist($user);
            //$lesPersonnes[]= $personne;
            $manager->flush();

            $this->addFlash('success', 'Votre compte est bien crée, vous pouvez maintenant vous connectez au site !');

            return $this->redirectToRoute('account_login');

        }

         return $this->render('account/registration.html.twig', [
             'form' =>$form->createView()

         ]);
    }

    /**
     * permet d'afficher et de traiter le fichier de modification du profil
     * 
     * @route("/account/profile",name ="account_profile")
     * 
     * @return Response
     */
    
    public function profile (Request $request, EntityManagerInterface $manager) {

        $user = $this->getUser();

        $form = $this->createForm(AccountType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid())
        {

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
              
                'success', 
                "les données du profil ont bien été enregistrés avec succès !"


            );
        }

        return $this->render('account/profile.html.twig',[
         'form' =>$form->createView()

        ]);



    }

    /**
     * Permet de modifier le mot de passe
     * 
     * @route("account/password-update", name="account_password")
     * 
     * @return Response
     */

    public function updatePassword (Request $request, UserPasswordEncoderInterface $encoder , EntityManagerInterface $manager){

            $passwordUpdate = new PasswordUpdate();

            $user = $this->getUser();

            $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

            $form->handleRequest($request);

            if ($form->isSubmitted()&& $form->isValid()) {

                   //vérifier que le old password est le même que celui de l'utilisateur

                   if(!password_verify($passwordUpdate->getOldPassword(),  $user->getMotDePasse())){
                       //erreur de mot de passe     
                       
                       $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez tapé n'est pas le mot de passe actuel!"));

                   }else
                       {

                          $newPassword = $passwordUpdate->getNewPassword();
                          $hash= $encoder->encodePassword($user, $newPassword);

                          $user->setMotDePasse($hash);

                          $manager->persist($user);
                          $manager->flush();

                          $this->addFlash(
              
                            'success', 
                            "Votre mot de passe a bien été modifié !"
            
            
                        );

                        return $this->redirectToRoute('accueil');
              
                       }



            }
    
        return  $this->render('account/password.html.twig', [ 'form' =>$form->createView()

        ]);




    }

    /**
     * Permet d'afficher le profil de l'utiliateur connecté
     * 
     * @Route("/account", name="account_index")
     * 
     * @return Response
     */

    public function myAccount(){

        {# avant user.html.twig #}

   return $this->render('account/account.html.twig',[

    'user' =>$this->getUser()

     ]);
}
    }


    /**
     * @Route("/account/forgottenPassword'" , name ="account_forgetPassword")
     * 
     */

     public function forgottenPassword (Request $request, UserRepository $repo, \Swift_Mailer $mailer,
     TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $manager)
     {
          // on lance le formulaire pour la saisie de l'email

          $form= $this->createForm(ResetpasswordType::class);

          // on traite la rêquete du formulaire

           $form->handleRequest($request);

           if($form->isSubmitted() && $form->isValid())
           {
                $infos= $form->getData();

                // vérification d l'existence du user 

                   $user = $repo->findOneByEmail($infos['email']);

                   if(!$user)
                   {
                       $this->addFlash('danger', 'cette adresse email  n\'est pas' );

                      return  $this->redirectToRoute('account_login');
                   }

                   // on crée un token

                   $token = $tokenGenerator->generateToken();

                   try 
                   {
                         $user->setResetToken($token);
                         $manager = $this->getDoctrine()->getManager();
                         $manager->persist($user);
                         $manager->flush();
                   }
                   catch(\Exception $e)
                   {
                       $this->addFlash('warning', 'il y\'a erreur :'. $e->getMessage());
                       return  $this->redirectToRoute('account_login');
                   }
                   // on génére l'url à envoyer par mail pour le reset du mot de passe

                   $url = $this->generateUrl('account_reset_password',['token' => $token],
                        UrlGeneratorInterface::ABSOLUTE_URL);

                  // on envoie le message
                  $message = (new \Swift_Message('oubli de mot de passe'))
                              ->setFrom('alihou.bxl@gmail.com')
                              ->setTo ($user->getEmail())
                              ->setBody(
                                 "<p>Bonjour </p> , <p> une demande de réinitialisation du mot de passe a été faite pour
                                  pour le site de GarageBah . Veuillez cliquer sur le lien suivant : " .$url .'</p>','text/html'


                              );

                              $mailer->send($message);

                              $this->addFlash('message' , 'un email de réinitialisation a été envoyé par mail');
                              return  $this->redirectToRoute('account_login');

           }
           
           return $this->render('account/forgottenPassword.html.twig', 
        
                     ['emailForm' => $form->createView()]);

           
           
     }


      /**
       * @Route("/account/resetPassword/{token}", name="account_reset_password")
       * 
       */

     public function resetPassword($token, Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $manager)

     {
        // on recherche le token dans l'entité User
         
          $user= $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        if(!$user)
        {

          $this->addFlash('danger' , 'Token inconnu');
          return $this->redirectToRoute('account_login');
        }
         
        // vérification de l'envoie du formulaire en post

        if ($request->isMethod('POST'))
        {
           // on reset le token à null 
           $user->setResetToken(null);

           $user->setMotDePasse(
               $encoder->encodePassword($user, $request->request->get('password')));
               $manager = $this->getDoctrine()->getManager();
               $manager->persist($user);
               $manager->flush();

               $this->addFlash('message', 'mot de passe modifié avec succès');

               return $this->redirectToRoute('account_login');   
        }
        else
        {
            return $this->render('account/resetPassword.html.twig' , ['token' => $token]);

        }
     }
}


   
