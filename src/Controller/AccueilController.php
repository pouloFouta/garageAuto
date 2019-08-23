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
}
