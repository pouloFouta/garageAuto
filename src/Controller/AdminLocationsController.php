<?php

namespace App\Controller;

use App\Entity\Location;
use App\Form\AdminLocationType;
use App\Repository\LocationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;




class AdminLocationsController extends AbstractController
{
    /**
     * 
     * @Route("/admin/locations", name="admin_locations_index")
     * @return Location[] Returns an array of Location objects
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repo->findAll();

        return $this->render('admin_garage/locations/index.html.twig', [
            'locations' => $locations
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

        $journal = $repo->findBy(array('statutLocation' => 'loué'),
                                     array('date_location' => 'desc'),
                                     5,
                                     0);
        return $this->render('admin_garage/locations/journal.html.twig', [
                                        'journal' => $journal
                                        ]);
    }

    /**
    *
     * @IsGranted("ROLE_ADMIN")
     * pour enregister une location
     * 
     * @Route("/admin/locations/add", name ="admin_locations_create")
     * 
     * @return Response
     */

    public function create( Request $request, EntityManagerInterface $manager) {

       
        $location= new Location();

        
        //$voiture = new Vehicule();
        $form = $this->createForm(AdminLocationType::class, $location);

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


               
                $voiture = $location->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            }
                
                
            
        
          
            
            $manager->persist($voiture);
            
            $manager->persist($location);
            $manager->flush();

            $this->addFlash(
                'success',
     
                "La location  a été ajouté "
            
            );
        
            return $this->redirectToRoute('admin_locations_index');
        }
    

   return $this->render('admin_garage/locations/new.html.twig' ,[
    'form' => $form->createView()

]);

   }


    /**
     * @IsGranted("ROLE_ADMIN")
     * pour modifier une location
     * 
     * @Route("admin/locations/{id}/edit", name ="admin_locations_edit")
     * 
     * @return Response
     */

    public function edit( Request $request, EntityManagerInterface $manager, Location $location) {
       
       
        $form = $this->createForm(AdminLocationType::class, $location);

        $form->handleRequest($request);

        //$product->setBrochureFilename(
           // new File($this->getParameter('brochures_directory').'/'.$product->getBrochureFilename())


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
                $voiture = $location->getVehicule();
                   // On crée l'image dans la base de données
                $voiture->setImageVehicule($newFilename);
            
            }
                
            
        
          
            // afin de faire fonctionner la modification de la location , 
            //il faudra choisir une image même si la même image (car le nom de l'image est génerer à chaque nouvelle soumission )
            $manager->persist($voiture);
            
            $manager->persist($location);
            $manager->flush();
            $this->addFlash(
                   
                'success',

                "La location a bien été modifiée"

              );
        
            return $this->redirectToRoute('admin_locations_index');
            
        
    }
    

   return $this->render('admin_garage/locations/edit.html.twig' ,[
     'location' => $location,  
    'form' => $form->createView()

]);

   }

    /**
     *  @IsGranted("ROLE_ADMIN")
     * pour supprimer une location
     * 
     * @Route("admin/locations/{id}/delete", name ="admin_locations_delete")
     * 
     * @return Response
     */

    public function delete (Location $location, EntityManagerInterface $manager ) {

        //if ($location->getStatutLocation() =="loué")
             // on récupère l'objet véhicule
            $vehicule = $location->getVehicule();
            // on récupère le nom de l'image 
            $uneimage= $vehicule->getImageVehicule();
            // on me supprime du répertoire uploads
            unlink($this->getParameter('images_directory').'/'.$uneimage);

            $manager->remove($location);
            $manager->flush();
     
            $this->addFlash(
                'success',
     
                "La location  a été supprimé "
            
            );
        

     /* else
        {
            $this->addFlash(
                'warning',
     
                'La réparation doit être conservé ' 
            
            );
        }*/

            return $this->redirectToRoute('admin_locations_index');


    }

}
