<?php

namespace App\Controller;

use App\Entity\Bon;
use App\Entity\TypeBon;
use App\Form\AdminTypeBonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminBonsController extends AbstractController
{
    /**
     * @Route("/admin/Typebons", name="admin_Typebons_index")
     */
    public function index()
    {

          $repo = $this->getDoctrine()->getRepository(TypeBon::class);

         $typeBons = $repo->findAll();
 
        return $this->render('admin_garage/typeBons/index.html.twig', [
            'typeBons' =>  $typeBons
        ]);
    }

    
    /**
     * permet d'encoder un Type de bon de réparation
     * 
     * @Route("admin/TypeBons/add" , name="admin_typeBons_create")
     * 
     */

    public function create(Request $request, EntityManagerInterface $manager)

    {
         $typeBon= new TypeBon();

     

         $form= $this->createForm(AdminTypeBonType::class, $typeBon);

         $form->handleRequest($request);
         // le tableau qui va contenir les bons à créer à partir de ce type debon
         $bons []=  new Bon();

         if($form->isSubmitted()&& $form->isValid())
         {
             $nb= $typeBon->getQuantite();

             for ($i=0; $i<=$nb-1;$i++)
             {
                $bons[$i] = new Bon();
              
                $bons[$i]->setTypeBon($typeBon);
                $bons[$i]->setValidite($typeBon->getValidite());  
                $typeBon->addBon($bons[$i]);    
                $manager->persist($bons[$i]) ;
             }

             
             $manager->persist($typeBon);
             $manager->flush();
             $this->addFlash(
                   
                'success',

                "Le type de bon a bien été ajouté"

              );


             return $this->redirectToRoute('admin_Typebons_index');
         }

         return $this->render('admin_garage/typeBons/new.html.twig', [

            'form' => $form->createView()

         ]);
        
        
  

    }
    
    /**
     * permet de modifier un Type de bon de réparation
     * 
     * @Route("admin/TypeBons/{id}/edit" , name="admin_typeBons_edit")
     * 
     */

    public function edit(TypeBon $typeBon ,Request $request,EntityManagerInterface $manager)

    {
         

     

         $form= $this->createForm(AdminTypeBonType::class, $typeBon);

         $form->handleRequest($request);
        
        

         if($form->isSubmitted()&& $form->isValid())
         {
            //  gérer quand la génération de nouveau bon
            //quand la quantité change
            //$nb= $typeBon->getQuantite();

             /*for ($i=0; $i<=$nb;$i++)
             {
                $bons[$i] = new Bon();
              
                $bons[$i]->setTypeBon($typeBon);
                $bons[$i]->setValidite($typeBon->getValidite());  
                $typeBon->addBon($bons[$i]);    
                $manager->persist($bons[$i]) ;
             }*/

             
             $manager->persist($typeBon);
             $manager->flush();
             $this->addFlash(
                   
                'success',

                "Le type de bon a bien été modifiée"

              );

             return $this->redirectToRoute('admin_Typebons_index');
         }

         return $this->render('admin_garage/typeBons/edit.html.twig', [

            'form' => $form->createView()

         ]);
        
        
  

    }
    /**
     * pour supprimer un type de bon
     * 
     * @Route("admin/TypeBons/{id}/delete", name ="admin_typeBons_delete")
     * 
     * @return Response
     */

    public function delete (TypeBon $typeBon, EntityManagerInterface $manager ) {

        // mettre une règle de sorte que si ce type a déja des clients
        //associés alors empêcher la suppression
        //if ($typeBon->getBons()
        //{

            $manager->remove($typeBon);
            $manager->flush();
     
            $this->addFlash(
                'success',
     
                "Le type de bon a été supprimé "
            
            );
        //}

      /*else
        {
            $this->addFlash(
                'warning',
     
                'Le type de bon ne peut-être supprimé' 
            
            );
        }*/

            return $this->redirectToRoute('admin_Typebons_index');


    }

    


}
