<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\MicroPost;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {        
    }



    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $user1= new User();
        $user1->setEmail('test@test.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '12345678'
            )
            );
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('john@test.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '12345678'
            )
        );
        $manager->persist($user2);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to Canada!');
        $microPost2->setText('Welcome to Canada!');
        $microPost2->setCreated(new DateTime());
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to Germany!');
        $microPost3->setText('Welcome to Germany!');
        $microPost3->setCreated(new DateTime());
        $manager->persist($microPost3);

        $microPost4 = new MicroPost();
        $microPost4->setTitle('Welcome to Iran!');
        $microPost4->setText('Welcome to Iran!');
        $microPost4->setCreated(new DateTime());
        $manager->persist($microPost4);

        $manager->flush();
    }
}
