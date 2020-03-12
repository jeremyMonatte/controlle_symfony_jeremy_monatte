<?php

namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(Request $request): Response
    {
        $people = new People();

        $form = $this->createForm(PeopleType::class, $people, [
            'action' => $this->generateUrl('accueil'),
            'method' => 'POST',
        ]);
        $success = false;
        $errors = $form->getErrors(true);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($people);
            $entityManager->flush();
            $success = true;
        }

        return $this->render('default/accueil.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
            'success' => $success
        ]);

    }

}
