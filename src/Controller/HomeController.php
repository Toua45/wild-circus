<?php

namespace App\Controller;

use App\Repository\PriceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(PriceRepository $priceRepository) : Response
    {
        $prices = $priceRepository->findOneBy([]);
        return $this->render('home/index.html.twig', [
            'prices' => $prices,
        ]);
    }
}
