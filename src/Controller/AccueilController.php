<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('location.html.twig');
    }

     /**
     * @Route("/ventes", name="ventes")
     */
    public function ventes()
    {
        return $this->render('vente.html.twig');
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

    
    




    /**
     * @Route("/connexion", name="connexion")
     */
    public function seConnecter()
    {
        return $this->render('connexion.html.twig');
    }

}
