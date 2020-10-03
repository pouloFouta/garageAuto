<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Vente;
use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Personne;
use App\Entity\MiseEnLocation;
use App\Form\ClientLocationType;
use App\Repository\LocationRepository;
use App\Repository\ReparationRepository;
use App\Repository\VenteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientsController extends AbstractController
{
   
   
    /**
     * permet de afficher la page qui sert à modifier 
     * le profil de l'utilisateur
     * @Route("/myAccount", name="user_show")
     * 
     */
    public function index()
    {
       

        return $this->render('user/index.html.twig', [
            'user' => $this->getUser()
        ]);
    }
   
   
   
    /**
     * permet de lister les achats du client
     *  @Route("/clients/ventes", name="client_ventes_index")
     */
    public function VentesListes(VenteRepository $repo)
    {
        //$statut="libre";
        //$repo = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $repo->findByStatut('libre');

        
    return $this->render('client_ventes/index.html.twig', [
        'ventes' => $ventes
    ]);
}

    /**
     * permet d'acheter un véhicule
     * @Route("clients/ventes/{id}/achat", name="client_ventes_achat")
     * 
     *  @return Response
     */

public function achatVehicule(Vente $vente, EntityManagerInterface $manager)

{
        
        
    $client= $this->getUser();
    if ($client instanceof Client)
        //dump ($client);
      
       $vente->setStatutVente('reservé pour achat');
       $vente->setClient($client);
       $vente->setDateVente(new \DateTime());
    
    
    $manager->persist($vente);
    $manager->flush();
     
    return $this->render('client_ventes/achat.html.twig', [
        'vente' => $vente
        
    ]);
    
    
}

/**
 * location véhicule par le client
 *  
 * @Route("clients/mesLocations/{id}", name="client_locations_louer")
 * 
 */


public function louerVehicule( Request $request, MiseEnLocation $miseLocation, EntityManagerInterface $manager  )

{
     $location = new Location();
    $form= $this->createForm(ClientLocationType::class);

    $form->handleRequest($request);

    $mesLocations = [];
    if ($form->isSubmitted()&& $form->isValid())
    {


    $client = $this->getUser();

   

    if ($client instanceof Client)
    {
   $location->setClient($client);
   $location->setMiseEnLocation($miseLocation);

    $dateDebut= $form->get('date_location')->getData();
   $dateFin= $form->get('date_fin')->getData();
   
   $nbjours = $dateFin->diff($dateDebut)->format("%a");

   $location->setDateLocation($dateDebut);
   $location->setDateFin($dateFin);
   $location->setVehicule($miseLocation->getVehicule());
   $prixTTc= $miseLocation->getPrixParJour() * $nbjours;
   $location->setPrix($prixTTc);
   $location->setMiseEnLocation($miseLocation);

   $meslocations[]=$location;
   $client->addLocation($location);
   $miseLocation->setStatutMise('reservé');

   
   //$vehicule = $location->getVehicule();
   //$location->setStatutLocation('loué');

   //si les dates choisis pour la location sont déja occupés
     if(!$location->verificationDatesLocations())
   
         {
             $this->addFlash(

                'warning',
                "les dates choisies sont déja réservées par autre un client."
             );
         }
         else
     {
  
   
   // méthode pour récupérer la donnée dans un formulaire
   //$dateDebut= $form->get('date_location')->getData();
   //$dateFin= $form->get('date_fin')->getData();
   // calcule du nombre de jours de la location
   /*$jours= ceil(abs($dateFin - $dateDebut) / 86400);

   $location->setDateFin($dateDebut);
   $location->setDateLocation($dateFin);
   $location->setVehicule($miseLocation->getVehicule());
   $prixTTc= $miseLocation->getPrixParJour() * ($jours);
   $location->setPrix($prixTTc);
   $location->setMiseEnLocation($miseLocation);

   $meslocations[]=$location;
   $client->addLocation($location);
   $miseLocation->setStatutMise('loué');*/

   
  
   $manager->persist($location);
   $manager->persist($miseLocation);
   $manager->flush();
   $this->addFlash(

    'success',

    "votre location a été enregistrée"

);

    }
    dump($location);
    
}
   return $this->redirectToRoute('client_locations_index');
    
    

    
}

return $this->render('client_locations/new.html.twig',[

            //'location' => $location,
            //'vehicule'  => $vehicule,
           
            'form' => $form->createView()


           ]);


}



/**
 * permet de lister les locations 
 * @Route("/clients/locations", name="client_locations_index")
 * 
 */

public function listeLocations ()
{
    //requête sql sur location pour récupérer seul les locations du client
    $repo = $this->getDoctrine()->getRepository(MiseEnLocation::class);

    $miseLocations = $repo->findAll();
    /*$miseLocations = $repo->findBy(
        ['client' => $this->getUser()],
    ['id' => 'ASC']
);*/


    
return $this->render('client_locations/index.html.twig', [
    'miseLocations' => $miseLocations
]);
}

/**
 * 
 * Liste des Mises en Localions en statut Libre
 */

/*public function listeMisesLocation(MiseEnLocation $repo)
{

   
}
*/

  /**
   *  permet d'afficher ls factures du client
   *  @Route("/clients/reparations", name="client_factures")
   */

public function lesFactures() 
{
  

}

/**
 * permet de lister les réparations du client
 * 
 * @Route("/clients/reparations", name="client_reparations")
 *
 * @return void
 */
public function mesReparations(ReparationRepository $repo)
{
   
    //$mesReparations = $repo->findByVehicule($this->g->getId()) ;   

    /*return $this->render('client_reparations/mesReparations.html.twig', [
            'mesLocations' => $mesLocations
        ]);*/
}


/**
 * 
 *
 * permet de lister les locations du client
 * @Route("/clients_locations/mesLocations", name="client_locations")
 *
 */

public function mesLocations( LocationRepository $repo)

{
     $mesLocations = $repo->findByClient($this->getUser()->getId()) ;   

return $this->render('client_locations/mesLocations.html.twig', [
        'mesLocations' => $mesLocations
    ]);
}

/**
 * permet de lister les achats du client
 * @Route("/clients_locations/mesAchats", name="client_achats")
 * 
 */

public function mesAchats(VenteRepository $repo)
{
    $mesAchats = $repo->findByClient($this->getUser()->getId()) ;   

    return $this->render('client_ventes/mesAchats.html.twig', [
            'mesAchats' => $mesAchats
        ]);
    }

}

