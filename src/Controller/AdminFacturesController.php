<?php

namespace App\Controller;

use App\Entity\Facture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminFacturesController extends AbstractController
{
    /**
     * @Route("/admin/factures", name="admin_factures_index")
     */
    public function index()
    {

         $repo= $this->getDoctrine()->getRepository(Facture::class);
         $factures = $repo->findAll();

        return $this->render('admin_factures/factures/index.html.twig', [
            'factures' => $factures
        ]);
    }

    
    /**
     * @Route("/admin/factures/add", name="admin_factures_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
          $facture = new Facture();

          $form = $this->createForm(AdminFactureType::class, $facture);
          $form->handleRequest($request);

          if ($form->isSubmitted() && $form->isValid())

          {


         
          $manager->persist($facture);
            $manager->flush();

            return $this->redirectToRoute('admin_factures_index');
        }

      return $this->render('admin_garage/factures/new.html.twig' ,[
            'form' => $form->createView()

      ]);

        
    }

     /**
     * @Route("/admin/factures/{id}/edit", name="admin_factures_edit")
     */
    public function edit(Facture $facture, Request $request,  EntityManagerInterface $manager)
    {

    }

     /**
     * @Route("/admin/factures/{id/}/delete", name="admin_factures_delete")
     */
    public function delete(Facture $facture, Request $request,  EntityManagerInterface $manager)
    {

    }
}
