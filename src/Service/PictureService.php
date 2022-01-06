<?php

namespace App\Service;

use App\Entity\Picture;
use App\Factory\PictureFactory;
use App\Repository\PictureRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Represent Picture service layer
 * Class PictureService
 * @package App\Service
 */
class PictureService
{
    /**
     * @var PictureRepository
     */
    private PictureRepository $pictureRepository;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;
    /**
     * @var PictureFactory
     */
    private PictureFactory $pictureFactory;
    /**
     * @var ApodClientService
     */
    private ApodClientService $apodClientService;

    public function __construct(
        PictureRepository $pictureRepository,
        EntityManagerInterface $entityManager,
        PictureFactory $pictureFactory,
        ApodClientService $apodClientService
    ) {
        $this->pictureRepository = $pictureRepository;
        $this->entityManager = $entityManager;
        $this->pictureFactory = $pictureFactory;
        $this->apodClientService = $apodClientService;
    }

    /**
     * Create new Picture from Apod data by date
     * If date not set use today as default
     * @param DateTime $date
     * @return Picture
     * @throws \Exception
     */
    public function addFromApod(DateTime $date = null): ?Picture
    {
        $date = $date ? $date : new DateTime();
        // check if an existing picture of the same date already exists
        if (!$this->pictureRepository->getByDate($date)) {
            $picture = $this->pictureFactory->createFromApodArray($this->apodClientService->fetchByDate($date));
            if ($picture) {
                // Save new picture if exists for $date
                $this->entityManager->persist($picture);
                $this->entityManager->flush();
                return $picture;
            }
        }
        return null;
    }


    public function getLast()
    {
        return $this->pictureRepository->getLast();
    }
}
