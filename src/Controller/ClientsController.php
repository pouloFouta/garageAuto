<?php

namespace App\Controller;


use App\Entity\User;
use App\Entity\Vente;
use App\Entity\Client;
use App\Entity\Location;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;
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
    public function VentesListes()
    {
        $repo = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $repo->findAll();

        
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
        
        //$client= $this->getUser();
        //dump ($client);
      
       $vente->setStatutVente ('reservé pour achat');
      // $vente->setClient($client);
        
       //$client = get_current_user();
       //$vente->setClient($client) ;

     
     

    

      

    
    
    
    $manager->flush();
     
    return $this->render('client_ventes/achat.html.twig', [
        'vente' => $vente
        
    ]);
    
    
}

/**
 * permet de lister les locations du client
 * @Route("/clients/locations", name="client_locations_index")
 * 
 */

public function listeLocations ()
{

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
