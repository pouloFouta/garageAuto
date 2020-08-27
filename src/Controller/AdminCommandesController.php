<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCommandesController extends AbstractController
{
    /**
     * @Route("/admin/commandes", name="admin_commandes")
     */
    public function index()
    {
        return $this->render('admin_commandes/index.html.twig', [
            'controller_name' => 'AdminCommandesController',
        ]);
    }
}
