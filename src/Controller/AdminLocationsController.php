<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminLocationsController extends AbstractController
{
    /**
     * @Route("/admin/location", name="admin_location_index")
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

    public function create ()
    {


    }
    public function edit ()
    {


    }
    public function delete()
    {


    }
}
