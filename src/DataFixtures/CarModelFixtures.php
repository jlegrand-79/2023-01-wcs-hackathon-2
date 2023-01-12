<?php

namespace App\DataFixtures;

use App\Entity\CarModel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CarModelFixtures extends Fixture
{

    const CARMODELS = [
        [
            'brand' => 'Peugeot',
            'year' => '2022',
            'energy' => 'electric',
            'model' => 'E-208',
            'description' => 'PEUGEOT E-208 (2E GENERATION)',
            'picture' => 'e-208.png',
            'category' => 'citadine',
            'seats' => '5',
            'boot_volume' => '265',
        ],
        [
            'brand' => 'Renault',
            'year' => '2022',
            'energy' => 'electric',
            'model' => 'MEGANE 5',
            'description' => 'RENAULT MEGANE 5',
            'picture' => 'megane-5.png',
            'category' => 'berline',
            'seats' => '5',
            'boot_volume' => '440',
        ],

        [
            'brand' => 'MG',
            'year' => '2022',
            'energy' => 'electric',
            'model' => 'MG5',
            'description' => 'MG MG5',
            'picture' => 'mg5.png',
            'category' => 'break',
            'seats' => '5',
            'boot_volume' => '479',
        ],

        [
            'brand' => 'Peugeot',
            'year' => '2022',
            'energy' => 'electric',
            'model' => 'TRAVELLER',
            'description' => 'PEUGEOT TRAVELLER',
            'picture' => 'traveller.png',
            'category' => 'monospace',
            'seats' => '8',
            'boot_volume' => '507',
        ],

        [
            'brand' => 'Renault',
            'year' => '2022',
            'energy' => 'electric',
            'model' => 'KANGOO 3 VAN',
            'description' => 'RENAULT KANGOO 3 VAN',
            'picture' => 'kangoo-3-van.png',
            'category' => 'utilitaire',
            'seats' => '3',
            'boot_volume' => '3900',
        ],

        [
            'brand' => 'Renault',
            'year' => '2021',
            'energy' => 'electric',
            'model' => 'TWIZY 45',
            'description' => 'RENAULT TWIZY 45',
            'picture' => 'twizy-45.png',
            'category' => 'sans permis',
            'seats' => '2',
            'boot_volume' => '0',
        ],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::CARMODELS as $key => $value) {

            $carModel = new CarModel();
            $carModel->setBrand(self::CARMODELS[$key]['brand']);
            $carModel->setYear(self::CARMODELS[$key]['year']);
            $carModel->setEnergy(self::CARMODELS[$key]['energy']);
            $carModel->setModel(self::CARMODELS[$key]['model']);
            $carModel->setDescription(self::CARMODELS[$key]['description']);
            $carModel->setPicture(self::CARMODELS[$key]['picture']);
            $carModel->setCategory(self::CARMODELS[$key]['category']);
            $carModel->setSeats(self::CARMODELS[$key]['seats']);
            $carModel->setBootVolume(self::CARMODELS[$key]['boot_volume']);
            $manager->persist($carModel);
        }
        $manager->flush();
    }
}
