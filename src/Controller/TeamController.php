<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team")
     */
    public function index(ArtistRepository $artistRepository)
    {
        $artists = $artistRepository->findAll();
        return $this->render('team/index.html.twig', [
            'artists' => $artists,
        ]);
    }
}
