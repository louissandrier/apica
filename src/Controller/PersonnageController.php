<?php

namespace App\Controller;

use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController
{
    /**
     *
     * @Route("/personnage", name="create_personnage", methods={"POST"})
     */
    public function addCitation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personnage = new Personnage();
        $personnage->setNom($_POST['nom']);

        $entityManager->persist($personnage);
        $entityManager->flush();

        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'https://localhost');
        $response->setContent('Saved new film with id '.$personnage->getId());
        return $response;
    }
}
