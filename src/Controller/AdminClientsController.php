<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminClientsController extends AbstractController
{
    /**
     * @Route("/admin/clients", name="admin_client_index")
     * 
     *
     */
    public function index()
    {

        $repo = $this->getDoctrine()->getRepository(Personne::class);

        $pers = $repo->findAll();

        $clients = [];
        foreach ($pers  as $unClient)
        {
            if ($unClient instanceof Client)

            {
                array_push($clients, $unClient);

            }
        }



        dump( $clients);
        return $this->render('admin_garage/clients/index.html.twig', [
            'clients' => $clients,
        ]);
    }
}
