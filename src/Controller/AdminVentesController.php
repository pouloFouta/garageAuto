<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Entity\Vente;
use App\Form\AdminVenteType;

use App\Form\AdminVehiculeVenteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



class AdminVentesController extends AbstractController
{
    /**
     *  @Route("/admin/ventes", name="admin_ventes_index")
     *  @return Vente[] Returns an array of Vente objects
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $repo->findAll();

        
    return $this->render('admin_garage/ventes/index.html.twig', [
        'ventes' => $ventes
    ]);
    }



    /** 
     * @IsGranted("ROLE_ADMIN")
 
     * pour enregister une vente
     * 
     * @Route("admin/ventes/add", name ="admin_ventes_create")
     * 
     * @return Response
     */

    public function create( Request $request, EntityManagerInterface $manager) {

       
        $vente= new Vente();

        
        //$voiture = new Vehicule();
        $form = $this->createForm(AdminVenteType::class, $vente);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'image transmise via la variable définit dans l'entité ImageVehicule
            
            /**  @var UploadedFile $uneimage */
            // aller d'abord sur l'objet véhicule  puis recupérer la valeur de imageFichier depuis le formulaire de ventes
            $uneimage =$form->get('vehicule')->get('imageFichier')->getData();
              dump($uneimage);
             
            // traitement du fichier téléchargé
            if ($uneimage) {
                $originalFilename = pathinfo($uneimage->getClientOriginalName(), PATHINFO_FILENAME);
                // choix du nom de l'image 
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uneimage->guessExtension();

                // copier l'image dans le dossier uploads référencer ici par images_directory
                try {
                    $uneimage->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }


               
                $voiture = $vente->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            }
                
                
            
        
          
            
            $manager->persist($voiture);
            
            $manager->persist($vente);
            $manager->flush();

            $this->addFlash(
                'success',
     
                "La vente  a été ajouté "
            
            );
        
            return $this->redirectToRoute('admin_ventes_index');
        }
    

   return $this->render('admin_garage/ventes/new.html.twig' ,[
    'form' => $form->createView()

]);

   }
    /**
     * @IsGranted("ROLE_ADMIN")
     * pour modifier une vente
     * 
     * @Route("admin/ventes/{id}/edit", name ="admin_ventes_edit")
     * 
     * @return Response
     */

    public function edit( Request $request, EntityManagerInterface $manager, Vente $vente) {
       
       
        $form = $this->createForm(AdminVenteType::class, $vente);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'image transmise via la variable définit dans l'entité ImageVehicule
            
            /**  @var UploadedFile $uneimage */
            // aller d'abord sur l'objet véhicule  puis recupérer la valeur de imageFichier depuis le formulaire de ventes
            $uneimage =$form->get('vehicule')->get('imageFichier')->getData();
              dump($uneimage);
             
            // traitement du fichier téléchargé
            if ($uneimage) {
                $originalFilename = pathinfo($uneimage->getClientOriginalName(), PATHINFO_FILENAME);
                // choix du nom de l'image 
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$uneimage->guessExtension();

                // copier l'image dans le dossier uploads référencer ici par images_directory
                try {
                    $uneimage->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // sinon chercher l'ancienne image du folder uploads 
                //et le setté à image du véhicule
                // $voiture = $vente->getVehicule();
                   //$uneimage= $voiture->getImageVehicule();
                // $form->set('vehicule')->set('imageFichier')->setData($uneimage);
                $voiture = $vente->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            
            }
            // ceci permet de retirer le client de la vente et donc libérer la vente
           if ($vente->getStatutVente()=="libre")
           {
               $vente->setClient(null);
           }
        
          
            // afin de faire fonctionner la modification de la vente , 
            //il faudra choisir une image même si la même image (car le nom de l'image est génerer à chaque nouvelle soumission )
            $manager->persist($voiture);
            
            $manager->persist($vente);
            $manager->flush();
            $this->addFlash(
                   
                'success',

                "La vente a bien été modifiée"

              );
        
            return $this->redirectToRoute('admin_ventes_index');
            
        
    }
    

   return $this->render('admin_garage/ventes/edit.html.twig' ,[
     'vente' => $vente,  
    'form' => $form->createView()

]);

   }

    /**
     * @IsGranted("ROLE_ADMIN")
     * pour supprimer une vente
     * 
     * @Route("admin/ventes/{id}/delete", name ="admin_ventes_delete")
     * 
     * @return Response
     */

    public function delete (Vente $vente, EntityManagerInterface $manager ) {

        //if ($vente->getStatut() =="enregistré")
             // on récupère l'objet véhicule
            $vehicule = $vente->getVehicule();
            // on récupère le nom de l'image 
            $uneimage= $vehicule->getImageVehicule();
            // on me supprime du répertoire uploads
            unlink($this->getParameter('images_directory').'/'.$uneimage);

            $manager->remove($vente);
            $manager->flush();
     
            $this->addFlash(
                'success',
     
                "La vente  a été supprimé "
            
            );
        

     /* else
        {
            $this->addFlash(
                'warning',
     
                'La réparation doit être conservé ' 
            
            );
        }*/

            return $this->redirectToRoute('admin_ventes_index');


    }

/**
     * pour enregistrer un achat de véhicule
     *  
     * @Route("admin/achat/create", name ="admin_ventes_edit")
     * 
     * @return Response
     */
// une autre option serait de se baser le formulaire de vente pour
// enregistrer un achat avec les champs nécessaires a mettre à jour
// (date montant , client)
}