<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private const NB_USER = 50;

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }


    public function load(ObjectManager $manager): void
    {


        $userAdmin = new User();

        //Encoder le password
        $passwordAdmin ='azerty123';
        $hashedPassword = $this->passwordHasher->hashPassword($userAdmin, $passwordAdmin);


        $userAdmin->setUsername('admin')
        ->setRoles(["ROLE_ADMIN"])
        ->setPassword($hashedPassword)
        ->setFirstname('Damien')
        ->setLastname('Lebon')
        ->setEmail('admin@gmail.com')
        
        ->setImage('');
        $manager->persist($userAdmin);

        $userAdmin2 = new User();

        //Encoder le password
        $passwordAdmin2 ='azerty123';
        $hashedPassword = $this->passwordHasher->hashPassword($userAdmin2, $passwordAdmin2);
        $userAdmin2->setUsername('rh@hb.com')
        ->setRoles(["ROLE_ADMIN"])
        ->setPassword($hashedPassword)
        ->setFirstname('Ressources')
        ->setLastname('Humaines')
        ->setEmail('rh@gmail.com')

        ->setImage('');
        $manager->persist($userAdmin2);



        // USERS 

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < self::NB_USER; $i++) {
          $user = new User();


          //Encoder le password
            $password = 'azerty123';
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);

          $user->setUsername($faker->userName())
          ->setRoles([])
          ->setPassword($hashedPassword)
          ->setFirstname($faker->realText(10))
          ->setLastname($faker->realText(10))
          ->setEmail($faker->email())

          ->setImage('');
          $manager->persist($user);
}

$manager->flush();
    }
}
