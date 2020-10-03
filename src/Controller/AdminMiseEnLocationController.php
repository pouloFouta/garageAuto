<?php

namespace App\Controller;

use App\Entity\MiseEnLocation;
use App\Form\AdminMiseLocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\MiseEnLocationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AdminMiseEnLocationController extends AbstractController
{
    /**
     * @Route("/admin/miselocation", name="admin_mise_en_location_index")
     */
    public function index(MiseEnLocationRepository $repo)
    {
        $miseLocations = $repo->findAll();
        return $this->render('admin_garage/mise_en_location/index.html.twig', [
            'miseLocations'=> $miseLocations
         
        ]);
    }


    /**
     * 
     * afficher le journal des locations
     * 
     * @Route ("admin/locations/journal", name="admin_locations_journal")
     */
    
    public function journalLocations(LocationRepository $repo)
    {
 
       // $statut = "loué";
        //$repo = $this->getDoctrine()->getRepository(Location::class);
        /*$journal = $repo->journalLocation();
        return $this->render('admin_garage/locations/journal.html.twig', [
            'journal' => $journal*/
        //]);

        $journal = $repo->findAll();

        /*$journal = $repo->findBy(array('statutMise' => 'loué'),
                                     array('date_location' => 'desc'),
                                     5,
                                     0);*/
        return $this->render('admin_garage/locations/journal.html.twig', [
                                        'journal' => $journal
                                        ]);
    }



    /**
    *
     * @IsGranted("ROLE_ADMIN")
     * pour enregister une location
     * 
     * @Route("/admin/miselocation/add", name ="admin_mise_en_locations_create")
     * 
     * @return Response
     */

    public function create( Request $request, EntityManagerInterface $manager) {

       
        $miseLocation= new MiseEnLocation();

        
        //$voiture = new Vehicule();
        $form = $this->createForm(AdminMiseLocationType ::class, $miseLocation);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'image transmise via la variable définit dans l'entité ImageVehicule
            
            /**  @var UploadedFile $uneimage */
            // aller d'abord sur l'objet véhicule  puis recupérer la valeur de imageFichier depuis le formulaire de location
            $uneimage =$form->get('vehicule')->get('imageFichier')->getData();
              dump($uneimage);
             
            // triatement du fichier téléchargé
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


               
                $voiture = $miseLocation->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            }
                
                
            
        
          
            
            $manager->persist($voiture);
            
            $manager->persist($miseLocation);
            $manager->flush();

            $this->addFlash(
                'success',
     
                "La mise en location  a été ajouté "
            
            );
        
            return $this->redirectToRoute('admin_mise_en_location_index');
        }
    

   return $this->render('admin_garage/mise_en_location/new.html.twig' ,[
    'form' => $form->createView()

]);

   }

   /**
    *
     * @IsGranted("ROLE_ADMIN")
     * pour modifier une mise en location
     * 
     * @Route("/admin/miselocation/{id}/edit", name ="admin_mise_en_locations_edit")
     * 
     * @return Response
     */

    public function edit( Request $request, EntityManagerInterface $manager, MiseEnLocation $miseEnLocation) {

        $form = $this->createForm(AdminMiseLocationType ::class, $miseEnLocation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // On récupère l'image transmise via la variable définit dans l'entité ImageVehicule
            
            /**  @var UploadedFile $uneimage */
            // aller d'abord sur l'objet véhicule  puis recupérer la valeur de imageFichier depuis le formulaire de ventes
            $uneimage =$form->get('vehicule')->get('imageFichier')->getData();
              //dump($uneimage);
             
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
                $voiture = $miseEnLocation->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            
            }
                
            
        
          
            // afin de faire fonctionner la modification de la location , 
            //il faudra choisir une image même si la même image (car le nom de l'image est génerer à chaque nouvelle soumission )
            $manager->persist($voiture);
            
            $manager->persist($miseEnLocation);
            $manager->flush();
            $this->addFlash(
                   
                'success',

                "La mise en location a bien été modifiée"

              );
        
            return $this->redirectToRoute('admin_mise_en_location_index');
            
        
    }
    

   return $this->render('admin_garage/mise_en_location/edit.html.twig' ,[
     'miseEnLocation' => $miseEnLocation,  
    'form' => $form->createView()

]);

        


}








}