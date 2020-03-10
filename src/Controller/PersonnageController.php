<?php

namespace App\Controller;


use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PersonnageController extends AbstractController
{
    /**
     *
     * @Route("/personnage", name="create_personnage", methods={"POST"})
     */
    public function addPersonnage(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $personnage = new Personnage();
        $personnage->setNom($_POST['nom']);

        $entityManager->persist($personnage);
        $entityManager->flush();

        return new Response('Saved new user with id '.$personnage->getId());
    }
}