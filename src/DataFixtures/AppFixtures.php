<?php

namespace App\DataFixtures;

use App\Service\ApodClientService;
use App\Service\PictureService;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private PictureService $pictureService;

    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }


    public function load(ObjectManager $manager): void
    {
        //add the picture of the last 3 day
        for ($day = 0; $day < 3; $day++) {
            $this->pictureService->addFromApod(new DateTime("- $day day"));
        }
    }
}
