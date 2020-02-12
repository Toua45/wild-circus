<?php

namespace App\Controller;

use App\Form\ArtistSearchType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/team", name="team")
     */
    public function index(ArtistRepository $artistRepository, Request $request)
    {
        $form = $this->get('form.factory')->createNamed('', ArtistSearchType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $search = $data['search'];
            $category = $data['category'];
            $artists = $artistRepository->findLikeName($search, $category);
        } else {
            $artists = $artistRepository->findBy([], ['firstname' => 'ASC']);
        }

        return $this->render('team/index.html.twig', [
            'artists' => $artists,
            'form' => $form->createView(),
        ]);
    }
}
