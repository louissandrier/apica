<?php

namespace App\Controller;


use App\Entity\Citation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class CitationController extends AbstractController
{
    /**
     *
     * @Route("/citation", name="create_citation", methods={"POST"})
     */
    public function addCitation(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $citation = new Citation();
        $citation->setCitation($_POST['citation']);
        $citation->setFilm($_POST['film']);
        $citation->setPersonnage($_POST['personnage']);

        $entityManager->persist($citation);
        $entityManager->flush();

        return new Response('Saved new user with id '.$citation->getId());
    }

}