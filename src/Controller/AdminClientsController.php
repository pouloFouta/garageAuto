<?php

namespace App\Controller;

use App\Entity\Role;
use App\Entity\User;
use App\Entity\Client;
use App\Entity\Personne;
use App\Form\ClientType;
use App\Entity\Reparateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

        $repo = $this->getDoctrine()->getRepository(User::class);

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

    /**
     * pour créer un client
     * 
     * @Route("admin/clients/add", name ="admin_client_create")
     * 
     * 
     */
    
    public function create ( Request $request, EntityManagerInterface $manager) {

        $client= new Client();

        $form = $this->createForm(ClientType::class, $client);

        $form->handleRequest($request);
        //$lesSpec= []; 

        if ($form->isSubmitted()&& $form->isValid())
        { 
          // $role = new Role('ROLE_USER'); 
           //$role= $client->addPersonneRole($role);

      

            
           
            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('admin_client_index');
        }

      return $this->render('admin_garage/clients/new.html.twig' ,[
            'form' => $form->createView()

      ]);


    }

}
