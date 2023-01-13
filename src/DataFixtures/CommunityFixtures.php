<?php

namespace App\DataFixtures;

use App\Entity\Community;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommunityFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $community = new Community();
        $community->setName('Ville de Lyon');
        $community->setCity('Lyon');
        $community->setPostalCode('69000');
        $community->setAccount($this->getReference('account_2'));
        $manager->persist($community);
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            AccountFixtures::class,
        ];
    }
}
