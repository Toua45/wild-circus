<?php

namespace App\Controller;

use App\Entity\Price;
use App\Form\PriceType;
use App\Repository\PriceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/price")
 */
class AdminPriceController extends AbstractController
{
    /**
     * @Route("/", name="admin_price_index", methods={"GET"})
     */
    public function index(PriceRepository $priceRepository): Response
    {
        return $this->render('price/index.html.twig', [
            'prices' => $priceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_price_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $price = new Price();
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($price);
            $entityManager->flush();
            $this->addFlash('success', "Les tarifs ont été crées");

            return $this->redirectToRoute('admin_price_index');
        }

        return $this->render('price/new.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_price_show", methods={"GET"})
     */
    public function show(Price $price): Response
    {
        return $this->render('price/show.html.twig', [
            'price' => $price,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_price_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Price $price): Response
    {
        $form = $this->createForm(PriceType::class, $price);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('warning', "Les tarifs ont été modifiés");

            return $this->redirectToRoute('admin_price_index');
        }

        return $this->render('price/edit.html.twig', [
            'price' => $price,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_price_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Price $price): Response
    {
        if ($this->isCsrfTokenValid('delete'.$price->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($price);
            $entityManager->flush();
            $this->addFlash('danger', "Les tarifs ont été supprimés");
        }

        return $this->redirectToRoute('admin_price_index');
    }
}
