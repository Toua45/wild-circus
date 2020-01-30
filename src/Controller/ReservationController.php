<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function request(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ReservationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $message = (new Email())
            ->from($data['mail'])
            ->to($this->getParameter('mailer_from'))
            ->subject('Réservation')
            ->html($this->renderView('reservation/mail.html.twig', [
                'message' => $data['message']]));
            $mailer->send($message);
            $this->addFlash(
                'success',
                "Votre message a bien été envoyé"
            );

            return $this->redirectToRoute("home");
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
