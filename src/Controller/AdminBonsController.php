<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminBonsController extends AbstractController
{
    /**
     * @Route("/admin/bons", name="admin_bons")
     */
    public function index()
    {
        return $this->render('admin_bons/index.html.twig', [
            'controller_name' => 'AdminBonsController',
        ]);
    }
}
