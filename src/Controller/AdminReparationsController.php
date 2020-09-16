<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Panne;
use App\Entity\Client;
use App\Entity\Personne;
use App\Entity\Vehicule;
use App\Entity\Reparateur;
use App\Entity\Reparation;
use App\Form\AdminReparationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminReparationsController extends AbstractController
{
    /**
     * @Route("/admin/reparations", name="admin_reparations_index")
     * 
     *   @return Reparation[] Returns an array of Reparation objects
     */
    public function index()
    {
       
        $repo = $this->getDoctrine()->getRepository(Reparation::class);
            $reparations = $repo->findAll();

            dump($reparations);
        return $this->render('admin_garage/reparations/index.html.twig', [
            'reparations' => $reparations
        ]);
    }
       

   
     /**
     * pour enregister une réparation
     * 
     * @Route("admin/reparation/add", name ="admin_reparation_create")
     * 
     * @return Response
     */

    public function create( Request $request, EntityManagerInterface $manager) {

       
        $reparation= new Reparation();

        $ve = new Vehicule();

        $client = new Client();
        
        
    
       

        $form = $this->createForm(AdminReparationType::class, $reparation);

        $form->handleRequest($request);

        $lesPannes =[];

        if ($form->isSubmitted()&& $form->isValid()) 
        {

            // récuperation de toutes les pannes depuis l'entité reparation
            $lesPannes= $reparation->getPannes();

           // dump ($lesPannes);
            
 
            foreach ($lesPannes as $unePanne)
            {
                   $unePanne->setReparation($reparation);
                   $manager->persist($unePanne);

            }
           
            // on recupère le vehicule avec ses valeurs depuis l'entité reparation 
            $ve = $reparation->getVehicule();
           
            
            
            //on récupère le client depuis le véhicule et on le persiste 

            $client = $ve->getClient();
            $manager->persist($client);
    
      
            $manager->persist($client);
            // on persiste le véhicule dans la table vehicule et après on persiste la réparation
            $manager->persist($ve);

             dump($reparation);
           
            

            $manager->persist($reparation);
            
           
            
            
            $manager->flush();

            $this->addFlash(
                'success',
     
                "La réparation  a été ajouté "
            
            );

  

            return $this->redirectToRoute('admin_reparations_index');
        }

      return $this->render('admin_garage/reparations/new.html.twig' ,[
            'form' => $form->createView()

      ]);


    }

    /**
     * pour mettre à jour une réparation
     * 
     * @Route("admin/reparation/{id}/edit", name ="admin_reparation_edit")
     * 
     * @return Response
     */

    public function edit(Reparation $reparation , Request $request,EntityManagerInterface $manager){

           $form= $this->createForm(AdminReparationType::class, $reparation);

           $form->handleRequest($request);

        

           if($form->isSubmitted() && $form->isValid())
           {

            $lesPannes= $reparation->getPannes();

           
            
 
            foreach ($lesPannes as $unePanne)
            {
                   $unePanne->setReparation($reparation);
                   $manager->persist($unePanne);

            }

             
              
             
            // on recupère le vehicule avec ses valeurs depuis l'entité reparation 
            $ve = $reparation->getVehicule();
           
            // on persiste le véhicule dans la table vehicule et après on persiste la réparation
            
            
            //on récupère le client depuis le véhicule

             $client = $ve->getClient();
             $manager->persist($client);
             $manager->persist($ve);

            $manager->persist($reparation);
            dump($reparation);
            
               $manager->flush();

               return $this->redirectToRoute('admin_reparations_index');

               $this->addFlash(
                   
                 'success',

                 "La réparation a bien été modifiée"

               );

           }

           return $this->render('admin_garage/reparations/edit.html.twig',[

            'reparation' => $reparation,
            'form' => $form->createView()


           ]);

                   

    }

    /**
     * pour supprimer une réparation
     * 
     * @Route("admin/reparation/{id}/delete", name ="admin_reparation_delete")
     * 
     * @return Response
     */

    public function delete (Reparation $reparation, EntityManagerInterface $manager ) {

        if ($reparation->getStatut() =="enregistré")
        {

            $manager->remove($reparation);
            $manager->flush();
     
            $this->addFlash(
                'success',
     
                "La réparation  a été supprimé "
            
            );
        }

      else
        {
            $this->addFlash(
                'warning',
     
                'La réparation doit être conservé ' 
            
            );
        }

            return $this->redirectToRoute('admin_reparations_index');


    }

    




    
}
