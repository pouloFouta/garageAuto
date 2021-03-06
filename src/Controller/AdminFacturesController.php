<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\AdminFactureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * 
 * @IsGranted("ROLE_ADMIN")
 */

class AdminFacturesController extends AbstractController
{
    /**
     * @Route("/admin/factures", name="admin_factures_index")
     */
    public function index()
    {

         $repo= $this->getDoctrine()->getRepository(Facture::class);
         $factures = $repo->findAll();

        return $this->render('admin_garage/factures/index.html.twig', [
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

          $ttc= ($facture->getMontantHorsTva() * $facture->getTva() +  $facture->getMontantHorsTva());
          dump($ttc);
          $facture->setMontant($ttc);
          
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
      $form = $this->createForm(AdminFactureType::class , $facture);

      $form->handleRequest($request);

      if($form->isSubmitted()&& $form->isValid()){

          $manager->persist($facture);
          $manager->flush();

          $this->addFlash(
             
             'success',
             'la facture a été modifiée ! '

          );

          return $this->redirectToRoute('admin_factures_index');

      }

     return $this->render('admin_garage/factures/edit.html.twig',[

          'facture'=> $facture,
          'form' => $form->createView()

    ]);
 }
    

     /**
     * @Route("/admin/factures/{id/}/delete", name="admin_factures_delete")
     */
    public function delete(Facture $facture, Request $request,  EntityManagerInterface $manager)
    {
         $manager->remove($facture);
         $manager->flush();
         $this->addFlash ('success', 'la facture a été supprimé');
         return $this->redirectToRoute('admin_factures_index');
    }

    /**
     * cette méthode génère une facture en version pdf avec 
     * la libraire Dompdf installé avec composer
     * 
     * @Route("/admin/factures/{id}/pdf", name="admin_factures_pdf")
     */

    public function pdfAction( Facture $facture)
    {
        

       // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('admin_garage/factures/facturePdf.html.twig', [
            'facture' => $facture
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("facture.pdf", [
            "Attachment" => true
        ]);
    }
}

        
    
      
        
    

