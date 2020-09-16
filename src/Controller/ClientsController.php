<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Vente;
use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Personne;
use App\Form\ClientLocationType;
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


public function louerVehicule( Request $request,Location $location, EntityManagerInterface $manager  )

{
    $form= $this->createForm(ClientLocationType::class);

    $form->handleRequest($request);

    $mesLocations = [];
    if ($form->isSubmitted()&& $form->isValid())
    {


    $client = $this->getUser();
    if ($client instanceof Client)
    {
   $location->setClient($client);
   //$vehicule = $location->getVehicule();
   //$location->setStatutLocation('loué');
   $jours= $form->get('nb_jours')->getData();
   // méthode pour récupérer la donnée dans un formulaire
   $date= $form->get('date_location')->getData();

   $location->setNbJours($jours);
   $location->setDateLocation($date);

   $meslocations[]=$location;
   $client->addLocation($location);
  

   $manager->persist($location);
   $manager->flush();
    }
    dump($location);
    

   return $this->redirectToRoute('client_locations_index');
    
    

    }

return $this->render('client_locations/new.html.twig',[

            'location' => $location,
            //'vehicule'  => $vehicule,
           
            'form' => $form->createView()


           ]);


}



/**
 * permet de lister les locations du client
 * @Route("/clients/locations", name="client_locations_index")
 * 
 */

public function listeLocations ()
{
    //requête sql sur location pour récupérer seul les locations du client
    $repo = $this->getDoctrine()->getRepository(Location::class);
    $locations = $repo->findAll();

    
return $this->render('client_locations/index.html.twig', [
    'locations' => $locations
]);


}

public function lesFactures() 
{


}

/**
 * permet de lister les réparations du client
 * 
 *
 * @return void
 */
public function mesReparations()
{

}

}
