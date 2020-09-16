<?php

namespace App\Controller;

use App\Entity\Reparateur;
use App\Entity\Reparation;
use App\Entity\GestionVehicule;
use App\Form\AdminGestionVehiculeType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\GestionVehiculeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminGestionVehiculeController extends AbstractController
{
    /**
     * @Route("/admin/gestionVehicule", name="admin_gestion_index")
     * @return GestionVehicule[] Returns an array of GestionVehicule objects
     */
    public function index(GestionVehiculeRepository $repository)
    {
        $gestions = $repository->findAll();
        return $this->render('admin_garage/gestion_vehicule/index.html.twig', [
            'gestions' => $gestions,
        ]);
    }

   /**
     * pour créer un gestion
     * 
     * @Route("admin/gestionVehicule/{id}/add", name ="admin_gestion_create")
     * 
     *  @return Response
     */
   
   
    public function create (Request $request, Reparation $reparation,  EntityManagerInterface $manager)

    {

        $gestion = new GestionVehicule();

        //$reparateur = get_current_user();
        //$gestion->setReparateur(string($reparateur));
        //$reparateur =$this->getUser();
        //$casted = new Reparateur ($reparateur);

       // $gestion->setReparateur($casted);
        

        $form= $this->createForm(AdminGestionVehiculeType::class, $gestion);

           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {

                
           
            $manager->persist($gestion);

            $manager->flush();

            return $this->redirectToRoute('admin_gestion_index');
        }

      return $this->render('admin_garage/gestion_vehicule/new.html.twig' ,[
            'form' => $form->createView()

      ]);


    }
}
