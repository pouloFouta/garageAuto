<?php

namespace App\Controller;


use App\Entity\Vente;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientVentesController extends AbstractController
{
     /**
     *  @Route("/clients/ventes", name="client_ventes_index")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Vente::class);
        $ventes = $repo->findAll();

        
    return $this->render('client_ventes/index.html.twig', [
        'ventes' => $ventes
    ]);
}

    /**
     *  @Route("/clients/ventes/achat", name="client_ventes_achat")
     */

public function byVehicule(Vente $vente)

{
    

}

}