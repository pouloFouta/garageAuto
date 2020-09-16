<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Form\AdminCommandeType;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommandesController extends AbstractController
{
    /**
     * @Route("/admin/commandes", name="admin_commandes_index")
     * @return Commande[] Returns an array of Commande objects
     */
    public function index()
    {
        $repo= $this->getDoctrine()->getRepository(Commande::class);
        $commandes = $repo->findAll();
        return $this->render('admin_garage/commandes/index.html.twig', [
            'commandes' => $commandes
        ]);
    }
    /**
     * @Route("/admin/commandes/add", name="admin_commandes_create")
     */
    public function create( Request $request, EntityManagerInterface $manager)
    {
           $commande = new Commande();

           $form = $this->createForm(AdminCommandeType::class , $commande);
           $form->handleRequest($request);

           $lignes =[];

     if ($form->isSubmitted() && $form->isValid())

     {
             $lignes= $commande->getLigneCommandes();

             foreach ($lignes as $ligne)
             
             {
                   

                     $ligne->setCommande($commande);
                     $manager->persist($ligne);

             }
              $manager->persist($commande);
              $manager->flush();
              $this->addFlash(

                    'success',

                    "la commande a été ajouté"

              );
            

              return $this->redirectToRoute('admin_commandes_index');

     }

        return $this->render('admin_garage/commandes/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/commandes/{id}/edit", name="admin_commandes_edit")
     */
    public function edit( Request $request, Commande $commande , EntityManagerInterface $manager)
    {

        $form = $this->createForm(AdminCommandeType::class , $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())

        {

           $manager->persist($commande);
           $manager->flush();

           $this->addFlash(

            'success',

            "la commande a été modifiée"

           );
            
           return  $this->redirectToRoute("admin_commandes_index");
        }

        return $this->render('admin_garage/commandes/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/admin/commandes/{id}/delete", name="admin_commandes_delete")
     */
    public function delete(Commande $commande , EntityManagerInterface $manager)
    {
              if ($commande->getEtat() =="envoyé")
              {
                   $this->addFlash(

                    'warning',

                    "la commande ne peut-être supprimé car elle est déja envoyée chez le fournisseur "
                   );
                 
              }

              else {

             $manager->remove($commande);
             $manager->flush();

              $this->addFlash(

                'success',

                "la commande a été supprimé"
              );
            }
         
        return $this->redirectToRoute('admin_commandes_index');
          
        
    }

   
}