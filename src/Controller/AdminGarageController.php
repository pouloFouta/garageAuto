<?php

namespace App\Controller;

use App\Repository\ReparateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminGarageController extends AbstractController
{
    /**
     * @Route("/admin/garage", name="admin_garage")
     */
    public function index()
    {
        return $this->render('admin_garage/accueil/index.html.twig', [
            'controller_name' => 'AdminGarageController',
        ]);
    }

    public function listesRepateurs(ReparateurRepository $reparateurRepository)
    {
              return $this-> render('admin_garage/reparateurs/index.html.twig' ,[

                     'reparateurs' => $reparateurRepository->findAll()

              ]);

    }
}
