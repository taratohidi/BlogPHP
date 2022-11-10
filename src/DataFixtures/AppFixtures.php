<?php

namespace App\DataFixtures;

use App\Entity\MicroPost;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

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
