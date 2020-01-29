<?php

namespace App\Controller;

use App\Entity\Representation;
use App\Form\RepresentationType;
use App\Repository\RepresentationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/representation")
 */
class AdminRepresentationController extends AbstractController
{
    /**
     * @Route("/", name="admin_representation_index", methods={"GET"})
     */
    public function index(RepresentationRepository $representationRepository): Response
    {
        return $this->render('representation/index.html.twig', [
            'representations' => $representationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_representation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $representation = new Representation();
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($representation);
            $entityManager->flush();

            return $this->redirectToRoute('admin_representation_index');
        }

        return $this->render('representation/new.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_representation_show", methods={"GET"})
     */
    public function show(Representation $representation): Response
    {
        return $this->render('representation/show.html.twig', [
            'representation' => $representation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_representation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Representation $representation): Response
    {
        $form = $this->createForm(RepresentationType::class, $representation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_representation_index');
        }

        return $this->render('representation/edit.html.twig', [
            'representation' => $representation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_representation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Representation $representation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$representation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($representation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_representation_index');
    }
}
