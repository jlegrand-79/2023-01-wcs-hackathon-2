<?php

namespace App\DataFixtures;

use App\Entity\Account;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const ACCOUNTS = [
        [
            'email' => 'user@mail.com',
            'roles' => ['ROLE_USER'],
            'password' => 'Aa_12345',
        ],
        [
            'email' => 'granted@mail.com',
            'roles' => ['ROLE_GRANTED_USER'],
            'password' => 'Aa_12345',
        ],
        [
            'email' => 'community@mail.com',
            'roles' => ['ROLE_COMMUNITY'],
            'password' => 'Aa_12345',
        ],
        [
            'email' => 'admmin@mail.com',
            'roles' => ['ROLE_ADMIN'],
            'password' => 'Aa_12345',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::ACCOUNTS as $key => $value) {
            $account = new Account();
            $account->setEmail(self::ACCOUNTS[$key]['email']);
            $account->setPassword(self::ACCOUNTS[$key]['password']);
            $account->setRoles(self::ACCOUNTS[$key]['roles']);
            $manager->persist($account);
        }
        $manager->flush();
    }
}
