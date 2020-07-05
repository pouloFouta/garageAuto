<?php

namespace App\Controller;

use App\Entity\Panne;
use App\Entity\Vehicule;
use App\Entity\Reparation;
use App\Form\AdminReparationType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Collections\ArrayCollection;

class AdminReparationsController extends AbstractController
{
    /**
     * @Route("/admin/reparations", name="admin_reparations_index")
     * 
     *  * @return Reparation[] Returns an array of Reparation objects
     */
    public function index()
    {
       
        $repo = $this->getDoctrine()->getRepository(Reparation::class);
            $reparations = $repo->findAll();

            dump($reparations);
        return $this->render('admin_garage/reparations/index.html.twig', [
            'reparations' => $reparations,
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
        
        
         /*$panne1= new Panne ();
         
        $panne1->setMotif('bruit roues avant');
        $panne1->setDatePanne(new DateTime());
        $panne1->setEstResolu(0);

        $panne2= new Panne();
              $panne2->setMotif('bruit roues arrières');
              $panne2->setDatePanne(new DateTime());
              $panne1->setEstResolu(0);
        $reparation->addPanne($panne1);
        $reparation->addPanne($panne2);*/
                   
       

        $form = $this->createForm(AdminReparationType::class, $reparation);

        $form->handleRequest($request);

        $lesPannes =[];

        if ($form->isSubmitted()&& $form->isValid()) 
        {

            // récupération de toutes les pannes depuis l'entité reparation
            $lesPannes= $reparation->getPannes();

            dump ($lesPannes);
            
 
            foreach ($lesPannes as $unePanne)
            {
                   $unePanne->setReparation($reparation);
                   $manager->persist($unePanne);

            }
           
            // on recupère le vehicule avec ses valeurs depuis l'entité reparation 
            $ve = $reparation->getVehicule();
            dump($ve);
            // on persiste le véhicule dans la table vehicule et après on persiste la réparation
            $manager->persist($ve);
            

            $manager->persist($reparation);
            
            //$manager->persist($panne);
            //$manager->persist($panne2);
            
            
            $manager->flush();

  

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

    public function edit(Reparation $reparation , Request $request,EntityManagerInterface $manager ){

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
            $manager->persist($ve);
            

            $manager->persist($reparation);
            
               $manager->flush();

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

       $manager->remove($reparation);
       $manager->flush();

       $this->addFlash(
           'success',

           "La réparation  <strong> {$reparation->getId()} </strong>  a été supprimé "
       
       );

            return $this->redirectToRoute('admin_reparations_index');


    }

    




    
}
