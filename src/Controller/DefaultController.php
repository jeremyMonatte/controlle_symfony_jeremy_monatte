<?php

namespace App\Controller;

use App\Entity\People;
use App\Form\PeopleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
            'success' => $success,
        ]);

    }
    /**
     * @Route("/ajax", name="ajax",methods={"POST"})
     */
    public function ajax(Request $request, SerializerInterface $serialize): Response
    {

        $people = new People();

        $form = $this->createForm(PeopleType::class, $people);

        $form->submit($request->request->all());

        $errors=[];
        $errors = $form->getErrors(true);

        if ($form->isValid() && $errors!=[]) {
            $entityManager = $this->getDoctrine()->getManager();
            $people->setCivilite($request->request->all()['people']['civilite']);
            $people->setName($request->request->all()['people']['name']);
            $people->setPrenom($request->request->all()['people']['prenom']);
            $people->setTel($request->request->all()['people']['tel']);
            $news = false;
            if (isset($request->request->all()['people']["news"])) {
                $news = true;
            }
            $people->setNews($news);
            $people->setEmail($request->request->all()['people']['email']);
            $entityManager->persist($people);
            $entityManager->flush();

            return new JsonResponse("ok");
        } else {
            $json = $serialize->serialize($errors, 'json');

            return new JsonResponse($json);
        }
    }
}
