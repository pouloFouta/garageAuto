<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\Reparateur;
use App\Form\PersonneType;
use App\Form\ReparateurType;
use Doctrine\ORM\EntityManager;
use App\Form\AdminReparateurType;
use App\Repository\PersonneRepository;
use App\Repository\ReparateurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminReparateursController extends AbstractController
{
    /**
     * @Route("/admin/reparateurs", name="admin_reparateurs_index")
     * 
     * @return Reparateur[] Returns an array of Personne objects
     */
    public function index ()
    {

       // vérifier si ce n'est pas class personne dans GetRepo;

       //$resu = $userRepository->findAll();
       //dump($resu);
       //dd
       
        /*$repo = $this->getDoctrine()->getRepository(Reparateur::class);
            $reparateurs = $repo->findAll();
             dump( $reparateurs)  ; */

             $repo = $this->getDoctrine()->getRepository(Personne::class) ; 
              $personnes = $repo->findAll();
              //dump( $reparateurs);
              //dd($reparateurs);
              $repa = [];
              foreach ($personnes  as $unrepa)
              {
                  if ($unrepa instanceof Reparateur)

                  {
                      array_push($repa, $unrepa);

                  }
              }

              //dd($repa);

      
        return  $this->render('admin_garage/reparateurs/index.html.twig', [
            'reparateurs' => $repa
        ]);
    }

    /**
     * pour créer un réparateur
     * 
     * @Route("admin/reparateurs/add", name ="admin_reparateur_create")
     * 
     * 
     */
    
    public function create ( Request $request, EntityManagerInterface $manager) {

        $reparateur= new Reparateur();

        $form = $this->createForm(AdminReparateurType::class, $reparateur);

        $form->handleRequest($request);

        if ($form->isSubmitted()&& $form->isValid()) 
        {

            $manager->persist($reparateur);
            $manager->flush();

            return $this->redirectToRoute('admin_reparateurs_index');
        }

      return $this->render('admin_garage/reparateurs/new.html.twig' ,[
            'form' => $form->createView()

      ]);


    }

    //@return Response

    /**
     * Pour éditer-modifier un réparateur
     * 
     * @Route("admin/reparateurs/{id}/edit", name="admin_reparateur_edit")
     * 
     * @return Response
     */

     // par injection des dépendances je passe un objet Reparation à ma fonction qui elle se charge de retrouver le concerné 
    public function edit( Reparateur $reparateur, Request $request, EntityManagerInterface $manager){

         /* cette fonction utlisation la notion de ParamConverter avec l'injection des dépendances, elle prend un reparateur
        en paramètre grâce au clik  puis recupère son id pour la suite
       

        /*$repo = $this->getDoctrine()->getRepository(Reparateur::class); cette façon nécessite l'appel de 
         2 paramètres dans edit le repo et l'id du réparateur  */
          
          //$repo = $this->getDoctrine()->getRepository(Reparateur::class);

          //$reparateur = $repo->find($nom);

          $form = $this->createForm(AdminReparateurType::class , $reparateur);

          $form->handleRequest($request);

          if($form->isSubmitted()&& $form->isValid()){

              $manager->persist($reparateur);
              $manager->flush();

              $this->addFlash(
                 
                 'success',
                 'les données du réparateur {$reparateur->getId()} ont été modifiées ! '

              );

              //return $this->redirectToRoute('admin_reparateurs_index');

          }

         return $this->render('admin_garage/reparateurs/edit.html.twig',[

              'reparateur'=> $reparateur,
              'form' => $form->createView()

        ]);
     }

  /**
   * Permet de supprimer un commentaire 
   * 
   * @Route("admin/reparateurs/{id}/delete" , name="admin_reparateur_delete")
   * 
   * 
   * @return  Response
   */



     public function delete(Reparateur $reparateur, EntityManagerInterface $manager){

            $manager->remove($reparateur);
            // envoie la requête de suppression dans la DB (confirmation)
            $manager->flush();

            $this->addFlash('success', 'le reparateur a été supprimé');

            return $this->redirectToRoute('admin_reparateurs_index');

     }



}

