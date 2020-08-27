<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Role;
use App\Entity\User;
use App\Entity\Personne;
use App\Entity\Responsable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
      private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
            $faker = Factory::create('fr-FR');

            // création du role admin
            $adminRole = new Role;
            $adminRole->setTitle('ROLE_ADMIN');
            $manager->persist($adminRole);
         
            // création du user avec les droits Admin
         
            $adminUser = new User ();
            $adminUser->setNom('Bah')
                      ->setPrenom('Alihou')
                      ->setEmail('alihou.bxl@gmail.com')
                      ->setMotDePasse($this->encoder->encodePassword($adminUser, 'password'))
                      ->addUserRole($adminRole);

                      $manager->persist($adminUser);
          
        // Gestion des utilisateurs

        /*$users = [];
        for ($i=1 ; $i <=10 ; $i++) {

             $user = new User;

             $hash = $this->encoder->encodePassword($user, 'password');

             $user->setPrenom($faker->firstName)
                  ->setNom($faker->lastName)
                  ->setEmail($faker->email)
                  ->setMotDePasse($hash);

                  $manager->persist($user);

                  $users []= $user;

        }
        // à voir la diff entre ObjectManager et  EntityManagerInterface
*/
        $manager->flush(); 
    }
}
