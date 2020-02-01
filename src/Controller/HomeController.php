<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Entity\RepresentationLike;
use App\Repository\PriceRepository;
use App\Repository\RepresentationLikeRepository;
use App\Repository\RepresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * Permet de liker ou unliker un spetacle
     *
     * @Route("/representation/{id}/like", name="representation_like")
     *
     * @param \App\Entity\Representation
     * @param \App\Repository\RepresentationLikeRepository
     * @return \Symfony\Component\HttpFoundation\Response;
     */
    public function like(Representation $representation, EntityManagerInterface $entityManager, RepresentationLikeRepository $likeRepo): Response
    {
        $user = $this->getUser();

        if (!$user) return $this->json([
            'code' => 403,
            'message' => 'Unauthorized'
        ], 403);

        if ($representation->isLikedByUser($user)) {
            $like = $likeRepo->findOneBy([
                'representation' => $representation,
                'user' => $user
            ]);

            $entityManager->remove($like);
            $entityManager->flush();

            return $this->json([
                'code' => 200,
                'message' => 'Like bien supprimé',
                'likes' => $likeRepo->count(['representation' => $representation])
            ], 200);
        }

        $like = new RepresentationLike();
        $like->setRepresentation($representation)
            ->setUser($user);

        $entityManager->persist($like);
        $entityManager->flush();

        return $this->json([
            'code' => 200,
            'message' => 'Like bien ajouté',
            'likes' => $likeRepo->count(['representation' => $representation])
        ], 200);
    }
}
