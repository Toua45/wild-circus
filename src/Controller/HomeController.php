<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Repository\PriceRepository;
use App\Repository\RepresentationRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RepresentationRepository $representationRepository, PriceRepository $priceRepository) : Response
    {
        $prices = $priceRepository->findOneBy([]);
        $representations = $representationRepository->findBy([], ['date' => 'DESC']);
        return $this->render('home/index.html.twig', [
            'representations' => $representations,
            'prices' => $prices,
        ]);
    }

    /**
     * @Route("/home/show-event/{id}", name="home_show")
     */
    public function show(Representation $representation)
    {
        return $this->render('home/show.html.twig', [
            'representation' => $representation
        ]);
    }
}
