<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AccountFixtures extends Fixture
{
    const ACCOUNTS = [
        [
            'email' => 'user@mail.com',
            'roles' => ['ROLE_USER'],
            'password' => '$2y$13$1HlERTKPKFttne.VtR0f9ephn9ayGb2yYPKjoOmPAs5xnsDWBbQyC',
            'is_community' =>'0'
        ],
        [
            'email' => 'granted@mail.com',
            'roles' => ['ROLE_GRANTED_USER'],
            'password' => '$2y$13$bKSGqTnieJbvFWcxWRu0UORhgvgJnfhNk8cPwpu2YRrr12d/pwn/O',
            'is_community' =>'0'
        ],
        [
            'email' => 'community@mail.com',
            'roles' => ['ROLE_COMMUNITY'],
            'password' => '$2y$13$58em3OHn7RhrPcLizC6i1.DwXjhXZRyv1xN/Po320XG86WNJOQfya',
            'is_community' =>'1'
        ],
        [
            'email' => 'admmin@mail.com',
            'roles' => ['ROLE_ADMIN'],
            'password' => '$2y$13$OeErXP9wgcq0sL3F535FS.OoAlHvDk/a97RfsfK62AR7Zn7I9BlIS',
            'is_community' =>'1'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACCOUNTS as $key => $value) {
            $account = new Account();
            $account->setEmail(self::ACCOUNTS[$key]['email']);
            $account->setPassword(self::ACCOUNTS[$key]['password']);
            $account->setRoles(self::ACCOUNTS[$key]['roles']);
            $account->setIsCommunity(self::ACCOUNTS[$key]['is_community']);
            $manager->persist($account);
        }
        $manager->flush();
    }
}
