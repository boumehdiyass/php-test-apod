<?php

namespace App\Controller;

use App\Service\PictureService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApodController extends AbstractController
{
    /**
     * @var PictureService
     */
    protected PictureService $pictureService;

    /**
     * ApodController constructor.
     * @param PictureService $pictureService
     */
    public function __construct(PictureService $pictureService)
    {
        $this->pictureService = $pictureService;
    }
    /**
     * @Route("/", name="apod")
     */
    public function index(): Response
    {
        return $this->render('apod/index.html.twig', [
            'picture' => $this->pictureService->getLast(),
        ]);
    }
}
