<?php

namespace App\Controller;

use App\Entity\Vente;
use App\Entity\Location;
use App\Repository\VenteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index()
    {
        return $this->render('accueil/index.html.twig');
    }

    /**
     * @Route("/entretien", name="entretien")
     */
    public function entretienDiagnostic()
    {
        return $this->render('entretien.html.twig');
    }
    /**
     * @Route("/location", name="location")
     */
    public function location()
    {
        $repo = $this->getDoctrine()->getRepository(Location::class);
        $locations = $repo->findAll();

        
    return $this->render('location.html.twig', [
        'locations' => $locations
    ]);

    }

     /**
     * @Route("/ventes", name="ventes")
     */
    public function ventes(VenteRepository $repo)
      
    {
        //$repo = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $repo->findByStatut('libre');

        
    return $this->render('vente.html.twig', [
        'ventes' => $ventes
    ]);
    }
    
    

     /**
     * @Route("/offres", name="offres")
     */
    public function offres()
    {
        return $this->render('offre.html.twig');
    }


     /**
     * @Route("/partenariat", name="partenariat")
     */


    public function partenariat()
    {
        return $this->render('partenariat.html.twig');
    }

     /**
     * @Route("/contact", name="contact")
     */


    public function contact()
    {
        return $this->render('contact.html.twig');
    }

    
    
    /**  a delete si possible
     * @Route("/connexion", name="connexion")
     */
    public function seConnecter()
    {
        return $this->render('connexion.html.twig');
    }

}
